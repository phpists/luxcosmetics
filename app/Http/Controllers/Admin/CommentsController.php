<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Comments;
use App\Services\FileService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $comment = Comments::query();

        if (isset($request->status)) {
            $comment->where('comments.status', $request->status);
        }

        $comment = $comment->paginate($request->paginate ?? 100);

        if ($request->ajax()) {
            $commentAjaxHtml = view('admin.comments.parts.table', ['commentAjax' => $comment])->render();
            $paginateHtml = view('admin.comments.parts.paginate', ['commentAjax' => $comment, 'params' => $request->all()])->render();

            return response()->json([
                'commentAjaxHtml' => $commentAjaxHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }
        return response()->view('admin.comments.index', compact('comment'));
    }
    public function edit($id)
    {
        $data['item'] = Comments::select('comments.*')->where('comments.id', $id)->first();
        return view('admin.comments.edit', $data);
    }

    public function update(Request $request)
    {
        $item = Comments::find($request->id);
        $item->description = $request->input('text');
        $item->created_at = $request->input('created_at');
        $item->status = $request->input('status');
        $item->save();
        return redirect()->route('admin.comment')->with('success', 'Комментарий успешно изменён');
    }

    public function delete($id)
    {
        $item = Comments::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.comment')->with('success', 'Коментарий успешно удалён');
    }
}
