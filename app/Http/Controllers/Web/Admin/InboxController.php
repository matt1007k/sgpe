<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Message;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreMessageRequest;

class InboxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $message = new Message;
        $this->authorize('viewAny', $message);

        $send = request('f') ? request('f') : 'me';
        $search = request('search') ? request('search') : '';

        $inboxes = Message::with('user')->filterSend($send)
            ->search($search)
            ->latest()
            ->paginate(10);

        return view('client.admin.inboxes.index', compact('inboxes', 'send', 'search', 'message'));
    }

    public function store(StoreMessageRequest $request)
    {
        $this->authorize('create', Message::class);

        $message = Auth::user()->messages()->create(
            $request->validated(),
        );

        event(new MessageCreated($message));

        request()->session()->flash('message', 'Correo enviado con exitó.');
        return response()->json(['success' => true]);
    }

    public function destroy(Message $inbox)
    {
        $this->authorize('forceDelete', $inbox);

        $inbox->delete();
        request()->session()->flash('message', 'Mensaje eliminado con exitó.');
        return response()->json(['success' => true]);
    }
}
