<?php

namespace App\Services;

use DateTime;

class HorizontalCalendar extends Calendar
{
    private int $nameLength = 12;

    public function setNameLength(int $length) : self {
        $this->nameLength = $length;
        return $this;
    }

    function displayMonth(int $month, int $year): string {
        $days = $this->getDaysOfMonth($month, $year);

        $content = '<h2>Tháng ' . ($month < 10 ? '0' . $month : $month) . '</h2>';
        $content .= '<p>';
        /** @var DateTime $d */
        foreach ($days as $d) {
            $content .= str_pad($this->getDayName($d, true), $this->nameLength, " ", STR_PAD_BOTH);
        }
        $content .= '</p>';

        $content .= '<p>';
        /** @var DateTime $d */
        foreach ($days as $d) {
            $content .= str_pad($d->format('d'), $this->nameLength, " ", STR_PAD_BOTH);
        }
        $content .= '</p>';

        return preg_replace('/\s/i', '&nbsp;', $content);
    }
}
