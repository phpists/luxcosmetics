<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackChat;
use App\Models\FeedbackMessageFile;
use App\Models\FeedbackReason;
use App\Models\ProductImage;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class FeedbackController extends Controller
{
    public function index(Request $request) {
        $this->authorize('viewAny', FeedbackChat::class);

        $chats = FeedbackChat::query()->orderBy('id', 'desc');
        $status_filter = $request->query('status', null);
        if ($status_filter !== null) {
            $chats = $chats->where('status', $status_filter);
        }
        if ($request->feedbacks_reason_id) {

            $chats->where('feedbacks_reason_id', $request->feedbacks_reason_id);
        }

        $themes = FeedbackReason::query()->get();

        $chats = $chats->paginate(15);
        if ($request->ajax()) {
            $productsHtml = view('admin.chats.parts.table', ['chats' => $chats, 'themes' => $themes])->render();
            $paginateHtml = view('admin.chats.parts.pagination', ['chats' => $chats, 'params' => $request->all()])->render();

            return response()->json([
                'productsHtml' => $productsHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }
        return view('admin.chats.index', compact('chats', 'themes'));
    }

    public function edit(Request $request, $id) {
        $this->authorize('update', FeedbackChat::class);

        $chat = FeedbackChat::query()->find($id);
        if ( $chat->status === FeedbackChat::NEW ) {
            $chat->update(['status' => 2]);
            $chat->save();
        }
        return view('admin.chats.chat', compact('chat'));
    }

    public function updateStatus(Request $request) {
        $this->authorize('update', FeedbackChat::class);

        $chat_ids = $request->checkbox;
        FeedbackChat::query()->whereIn('id', $chat_ids)->update([
            'status' => $request->status
        ]);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Статус успешно обновлен',
                'title' => SiteService::getChatStatus($request->status)
            ]);
        }
        else {
            return redirect()->route('admin.chats')->with('success', 'Статус тикета обновлен');
        }
    }

    public function destroy(Request $request, FeedbackChat $chat)
    {
        $chat->delete();
        return to_route('admin.chats')->with('success', 'Тикет удален');
    }

}
