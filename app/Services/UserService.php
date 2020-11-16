<?php

namespace App\Services;

use App\Models\User;
use App\Services\MonthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserService
{
    protected $last_months;
    protected $urlBase;

    public function __construct(int $last_months = 4)
    {
        $this->last_months = $last_months;
    }

    public function getUsersCountByLastMounts()
    {
        $items = array();
        $months = (new MonthService())->getLastMonths();
        foreach ($months as $month) {
            $count_verified = User::whereMonth('created_at', $month['number'])->where('status', 'verified')->get()->count();
            $count_unverified = User::whereMonth('created_at', $month['number'])->where('status', 'unverified')->get()->count();
            array_push($items, [
                $month['short_name'],
                $count_verified,
                $count_unverified
            ]);
        }
        return $items;
    }

    public function getMyPayments()
    {
        $filterYear = request('year') ? request('year') : date('Y');
        // $dni = '28211740';
        $dni = Auth::user()->dni;

        // $urlBase = 'http://scp.sharedwithexpose.com/api/v1/';
        $token = 'dfdsfsd';
        $this->urlBase = config('app.url_api');

        $years = Http::get($this->urlBase . "/years?dni={$dni}")->json();
        $payments = Http::withToken($token)->get($this->urlBase . "/payments?year={$filterYear}&dni={$dni}")->json();

        return [
            $years, $payments
        ];
    }
}
