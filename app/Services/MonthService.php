<?php

namespace App\Services;

class MonthService
{
    protected $month_number;
    protected $last_months;

    public function __construct(int $month_number = 1, int $last_months = 4)
    {
        $this->month_number = $month_number;
        $this->last_months = $last_months;
    }

    public function getMounthsForYear()
    {
        return [
            ['number' => '01', 'name' => 'Enero', 'short_name' => 'Ene'],
            ['number' => '02', 'name' => 'Febrero', 'short_name' => 'Feb'],
            ['number' => '03', 'name' => 'Marzo', 'short_name' => 'Mar'],
            ['number' => '04', 'name' => 'Abril', 'short_name' => 'Abr'],
            ['number' => '05', 'name' => 'Mayo', 'short_name' => 'May'],
            ['number' => '06', 'name' => 'Junio', 'short_name' => 'Jun'],
            ['number' => '07', 'name' => 'Julio', 'short_name' => 'Jul'],
            ['number' => '08', 'name' => 'Agosto', 'short_name' => 'Ago'],
            ['number' => '09', 'name' => 'Septiembre', 'short_name' => 'Sep'],
            ['number' => '10', 'name' => 'Octubre', 'short_name' => 'Oct'],
            ['number' => '11', 'name' => 'Noviembre', 'short_name' => 'Nov'],
            ['number' => '12', 'name' => 'Diciembre', 'short_name' => 'Dic'],
        ];
    }

    public function getShortName()
    {
        foreach ($this->getMounthsForYear() as $month) {
            if ($this->month_number == $month['number']) {
                return $month['short_name'];
            }
        }
    }

    public function getLastMonths()
    {
        $months = array();
        for ($i = 0; $i <  $this->last_months; $i++) {
            $month = (int)date('m') - $i;
            $this->month_number = $month;
            $short_name = $this->getShortName();
            array_push($months, [
                "number" => $month,
                "short_name" => $short_name,
            ]);
        }
        return collect($months)->sortBy('number');
    }
}
