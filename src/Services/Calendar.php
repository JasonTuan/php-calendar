<?php

namespace App\Services;

use DateTime;

abstract class Calendar
{
    public array $dayNamesVi = [
        "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật",
    ];

    public array $dayNamesShortVi = [
        "T2", "T3", "T4", "T5", "T6", "T7", "CN",
    ];

    public array $dayNamesEn = [
        "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday",
    ];

    public array $dayNamesShortEn = [
        "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su",
    ];

    public array $dayNames = [];

    public array $dayNamesShort = [];

    abstract function displayMonth(int $month, int $year) : string;

    public function __construct(string $lang = "vi")
    {
        if ($lang == "vi") {
            $this->dayNames = $this->dayNamesVi;
            $this->dayNamesShort = $this->dayNamesShortVi;
        } else {
            $this->dayNames = $this->dayNamesEn;
            $this->dayNamesShort = $this->dayNamesShortEn;
        }
    }

    function displayCalendar(int $year): string
    {
        $content = '<h1>Năm ' . $year . '</h1>';
        for ($i = 1; $i <= 12; $i++) {
            $content .= $this->displayMonth($i, $year);
        }

        return $content;
    }

    public function getDayName(DateTime $d, bool $shortName = false): string {
        $day = $d->format("N") - 1;

        return $shortName ? $this->dayNamesShort[$day] : $this->dayNames[$day];
    }

    /**
     * @param int $month
     * @param int|null $year
     * @return array
     */
    public function getDaysOfMonth(int $month, ?int $year) : array {
        if (empty($year))
        {
            $year = intval(date("Y"));
        }
        $days = [];
        $first = 1;
        $last = intval(date("t", strtotime("$year-$month-01")));
        for ($i = $first; $i <= $last; $i++) {
            $d = new DateTime("$year-$month-$i");
            $days[] = $d;
        }

        return $days;
    }
}
