<?php

namespace App\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $dni = '28211740';

        $urlBase = 'http://localhost:8001/api/v1/';
        $token = 'dfdsfsd';

        $years = Http::get($urlBase . "years?dni={$dni}")->json();
        $payments = Http::withToken($token)->get($urlBase . "payments?year={$filterYear}&dni={$dni}")->json();

        return view('client.pages.index', compact('payments', 'years', 'filterYear'));
    }
}
