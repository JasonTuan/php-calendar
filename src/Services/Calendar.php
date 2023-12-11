<?php

namespace App\Services;

use DateTime;
use SVG\Nodes\Texts\SVGText;
use SVG\SVG;

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

    abstract function displayMonthHtml(int $month, int $year) : string;

    abstract function displayMonthText(int $month, int $year) : string;

    abstract function displayMonthSvg(SVG $svg, int &$height, int $month, int $year, string $color, string $colorSat, string $colorSun);

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

    function displayCalendarHtml(int $year): string
    {
        $content = '<h1>Năm ' . $year . '</h1>';
        for ($i = 1; $i <= 12; $i++) {
            $content .= $this->displayMonthHtml($i, $year);
        }

        return $content;
    }

    function displayCalendarText(int $year): string
    {
        $content = "Năm $year". PHP_EOL;
        for ($i = 1; $i <= 12; $i++) {
            $content .= $this->displayMonthText($i, $year);
        }

        return $content;
    }

    function displayCalendarSvg(int $year, string $color, string $colorSat, string $colorSun): SVG
    {
        $image = new SVG(1920, 1920);
        $doc = $image->getDocument();
        $height = 40;

        $svg = new SVGText("Năm $year", 0, $height);
        $svg->setStyle('fill', $color);
        $doc->addChild($svg);
        for ($i = 1; $i <= 12; $i++) {
            $this->displayMonthSvg($image, $height, $i, $year, $color, $colorSat, $colorSun);
        }

        return $image;
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
