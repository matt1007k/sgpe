<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
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
        $filterYear = request('year') ? request('year') : date('Y');
        // $dni = '28211740';
        $dni = Auth::user()->dni;

        $urlBase = 'http://scp.test/api/v1/';
        // $urlBase = 'http://scp.sharedwithexpose.com/api/v1/';
        $token = 'dfdsfsd';

        $years = Http::get($urlBase . "years?dni={$dni}")->json();
        $payments = Http::withToken($token)->get($urlBase . "payments?year={$filterYear}&dni={$dni}")->json();

        return view('client.pages.index', compact('payments', 'years', 'filterYear'));
    }
}
