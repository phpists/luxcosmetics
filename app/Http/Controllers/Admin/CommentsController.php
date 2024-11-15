<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Comments;
use App\Models\Product;
use App\Services\FileService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Comments::class);

        $comment = Comments::query();

        if (isset($request->status)) {
            $comment->where('comments.status', $request->status);
        }

        $comment = $comment->orderBy('created_at', 'desc')->paginate($request->paginate ?? 100);

        $statusOptions = [
            'Новый' => 'Новый',
            'Опубликовать' => 'Опубликован',
            'Отменить' => 'Отменён'
        ];

        if ($request->ajax()) {
            $commentAjaxHtml = view('admin.comments.parts.table', ['comment' => $comment, 'statusOptions' => $statusOptions])->render();
            $paginateHtml = view('admin.comments.parts.paginate', ['commentAjax' => $comment, 'params' => $request->all()])->render();

            return response()->json([
                'commentAjaxHtml' => $commentAjaxHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }

        return response()->view('admin.comments.index', compact('comment', 'statusOptions'));
    }
    public function edit($id)
    {
        $this->authorize('update', Comments::class);

        $data['item'] = Comments::select('comments.*')->where('comments.id', $id)->first();
        return view('admin.comments.edit', $data);
    }

    public function update(Request $request)
    {
        $this->authorize('update', Comments::class);

        $itemId = $request->input('item_id');
        if($itemId == null) {
            $item = Comments::find($request->id);
            $item->description = $request->input('text');
            $item->created_at = $request->input('created_at');
            $item->status = $request->input('status');
            $item->save();
            return redirect()->route('admin.comment')->with('success', 'Комментарий успешно изменён');
        }
        $itemAjax = Comments::find($request->input('item_id'));
        $itemAjax->status = $request->status;
        $itemAjax->update();
        return response()->json(['message' => 'Статус успешно сохранен']);
    }

    public function delete($id)
    {
        $this->authorize('delete', Comments::class);

        $item = Comments::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.comment')->with('success', 'Коментарий успешно удалён');
    }
}
