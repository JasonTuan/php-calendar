<?php

namespace App\Services;

use DateTime;
use SVG\SVG;

class GridCalendar extends Calendar
{

    function displayMonthHtml(int $month, int $year): string
    {
        $days = $this->getDaysOfMonth($month, $year);

        $content = '<h2>Tháng ' . ($month < 10 ? '0' . $month : $month) . '</h2>';

        $content .= '<table class="table calendar-grid">';

        $content .= '<thead>';
        $content .= '<tr>';
        $i = 0;
        /** @var DateTime $d */
        foreach ($this->dayNames as $name) {
            $content .= '<th'. ($i >= 5 ? ' class="weekend"' : '') .'>' . $name . '</th>';
            $i++;
        }
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        /** @var DateTime $d */
        foreach ($days as $d) {

            if ($d->format('d') == 1 || $d->format('N') - 1 == 0) {
                $content .= '<tr>';
                $content .= str_repeat('<td class="other"></td>', $d->format('N') - 1);
            }
            $content .= '<td'. ($d->format('N') - 1 >= 5 ? ' class="weekend"' : '') .'>' . $d->format('d') . '</td>';

            if ($d->format('N') - 1 == 6) {
                $content .= '</tr>';
            }
            elseif ($d->format('d') == $d->format('t')) {
                $content .= str_repeat('<td class="other"></td>', 7 - $d->format('N'));
                $content .= '</tr>';
            }
        }
        $content .= '</tbody>';

        $content .= '</table>';

        return $content;
    }

    function displayMonthText(int $month, int $year): string
    {
        // TODO: Implement displayMonthText() method.
    }

    function displayMonthSvg(SVG $svg, int &$height, int $month, int $year, string $color, string $colorSat, string $colorSun)
    {
        // TODO: Implement displayMonthSvg() method.
    }
}
