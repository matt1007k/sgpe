<?php

namespace App\Http\Controllers\Web\Admin;

use App\Events\MessageCreated;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $send = request('f') ? request('f') : 'me';
        $search = request('search') ? request('search') : '';

        $inboxes = Message::with('user')->filterSend($send)
            ->search($search)
            ->latest()
            ->paginate(10);

        return view('client.admin.inboxes.index', compact('inboxes', 'send', 'search'));
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Auth::user()->messages()->create(
            $request->validated(),
        );

        event(new MessageCreated($message));

        return redirect()->route('inboxes.index')->with('message', 'Correo enviado con exitó.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        dd($message);
        return redirect()->route('inboxes.index')->with('message', 'Correo eliminado con exitó.');
    }
}
