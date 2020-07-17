<?php

namespace App\Services;

use App\Models\User;
use App\Services\MonthService;

class UserService
{
    protected $last_months;

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
}
