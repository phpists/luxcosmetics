<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CommentsAction;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionMessage;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        if (Auth::check()) {
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            $data['name'] = $name;
            $data['email'] = $email;
        }
        Comments::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'product_id' => $data['product_id']
        ]);

        return redirect()->back()->with('success', 'Спасибо, комментарий отправлен на модерацию');
    }
    public function sortComments(Request $request)
    {
        $sortOption = $request->input('sort_option');

        if ($sortOption === 'newest') {
            $comments = Comments::query()
                ->select(['comments.*', 'comments_actions.is_like as is_like'])
                ->leftJoin('comments_actions', function (JoinClause $join) use ($request) {
                    $join
                        ->on('comments_actions.record_id', '=', 'comments.id')
                        ->where('comments_actions.client_ip', $request->ip())
                        ->where('comments_actions.table_name', 'comments');
                })
                ->orderBy('created_at', 'desc')
                ->where('status', 'Опубликовать')
                ->paginate(Comments::ITEMS_PER_PAGE);

        } elseif ($sortOption === 'highest_rating') {
            $comments = Comments::query()
                ->select(['comments.*', 'comments_actions.is_like as is_like'])
                ->leftJoin('comments_actions', function (JoinClause $join) use ($request) {
                    $join
                        ->on('comments_actions.record_id', '=', 'comments.id')
                        ->where('comments_actions.client_ip', $request->ip())
                        ->where('comments_actions.table_name', 'comments');
                })
                ->orderBy('like', 'desc')
                ->where('status', 'Опубликовать')
                ->paginate(Comments::ITEMS_PER_PAGE);
        }
        if ($request->ajax()) {
            $comments = view('products.product_comments', ['comments' => $comments])->render();

            return response()->json([
                'comments' => $comments,
            ]);
        }

        return response()->json(['comments' => $comments]);
    }
    public function loadComments(Request $request)
    {
        $comments = Comments::query()->select(['comments.*', 'comments_actions.is_like as is_like'])
            ->leftJoin('comments_actions', function (JoinClause $join) use ($request) {
                $join
                    ->on('comments_actions.record_id', '=', 'comments.id')
                    ->where('comments_actions.client_ip', $request->ip())
                    ->where('comments_actions.table_name', 'comments');
            })
            ->where('product_id', $request->product_id)
            ->where('status', 'Опубликовать')
            ->paginate(Comments::ITEMS_PER_PAGE, ['*'], 'page', $request->page);
        $html = view('products.product_comments', compact('comments'))->render();
        return response()->json([
            'htmlBody' => $html,
            'hasMore' => $comments->hasMorePages()
        ]);
    }
    public function like(Request $request)
    {
        $recordId = $request->input('record_id');

        if ($request->table_name === 'product_questions') {
            $record = ProductQuestion::query()->find($recordId);
        }
        else {
            $record = Comments::query()->find($recordId);
        }

        $existingAction = CommentsAction::where('client_ip', $request->ip())
            ->where('record_id', $recordId)
            ->first();
        $count = 0;
        if (!$existingAction) {
            $data = [
                'is_like' => $request->input('isLiked'),
                'record_id' => $recordId,
                'table_name' => $request->table_name,
                'client_ip' => $request->ip()
            ];
            $commentAction = new CommentsAction($data);
//            $commentAction->client_ip = $request->ip();
//            $commentAction->is_like = $request->input('isLiked');
//            $commentAction->record_id = $recordId;
//            $commentAction->table_name = $request->table_name;
            $commentAction->save();
            if ((bool)$request->isLiked) {
                $record->like = $record->like + 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike + 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        elseif ((bool)$existingAction->is_like === (bool)$request->isLiked) {
            $existingAction->delete();
            if ((bool)$request->isLiked) {
                $record->like = $record->like - 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike - 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        else {
            $existingAction->update([
                'is_like'=> $request->isLiked
            ]);
            if ((bool)$request->isLiked) {
                $record->like = $record->like + 1;
                $record->dislike = $record->dislike - 1;
                $count = $record->like;
            }
            else {
                $record->dislike = $record->dislike + 1;
                $record->like = $record->like - 1;
                $count = $record->dislike;
            }
            $record->save();
        }
        return response()->json(['like' => $record->like, 'dislike' => $record->dislike]);
    }
}
