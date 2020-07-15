<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect('/payments');
        }

        $users_count = User::all()->count();
        $sended_me_count = Message::send('me')->get()->count();
        $recivied_me_count = Message::send('send')->get()->count();

        return view('admin.home', compact(
            'users_count',
            'sended_me_count',
            'recivied_me_count'
        ));
    }
}
