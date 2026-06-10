<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::latest()->paginate(15),
            'unreadCount' => Message::where('status', 'unread')->count(),
        ]);
    }

    public function show(int $id): View
    {
        $message = Message::findOrFail($id);

        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(int $id): RedirectResponse
    {
        Message::findOrFail($id)->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
