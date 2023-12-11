<?php

namespace App\Services;

use DateTime;
use SVG\Nodes\Texts\SVGText;
use SVG\SVG;

class HorizontalCalendar extends Calendar
{
    private int $nameLength = 12;

    public function setNameLength(int $length) : self {
        $this->nameLength = $length;
        return $this;
    }

    function displayMonthHtml(int $month, int $year): string {
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

    function displayMonthText(int $month, int $year): string {
        $days = $this->getDaysOfMonth($month, $year);

        $content = 'Tháng ' . ($month < 10 ? '0' . $month : $month) . PHP_EOL;
        /** @var DateTime $d */
        foreach ($days as $d) {
            $content .= str_pad($this->getDayName($d, true), $this->nameLength, " ", STR_PAD_BOTH);
        }
        $content .= PHP_EOL;

        /** @var DateTime $d */
        foreach ($days as $d) {
            $content .= str_pad($d->format('d'), $this->nameLength, " ", STR_PAD_BOTH);
        }
        $content .= PHP_EOL;

        return $content;
    }

    function displayMonthSvg(SVG $svg, int &$height, int $month, int $year, string $color, string $colorSat, string $colorSun)
    {
        $days = $this->getDaysOfMonth($month, $year);
        $doc = $svg->getDocument();

        $height += 40;
        $svg = new SVGText('Tháng ' . ($month < 10 ? '0' . $month : $month), 0, $height);
        $svg->setStyle('fill', $color);
        $doc->addChild($svg);

        $height += 40;
        $space = 0;
        /** @var DateTime $d */
        foreach ($days as $d) {
            $space += $this->nameLength;
            $svg = new SVGText($this->getDayName($d, true), $space, $height);
            switch ($d->format('N') - 1) {
                case 5:
                    $svg->setStyle('fill', $colorSat);
                    break;
                case 6:
                    $svg->setStyle('fill', $colorSun);
                    break;
                default:
                    $svg->setStyle('fill', $color);
                    break;
            }
            $doc->addChild($svg);
            $space += $this->nameLength;
        }

        $height += 40;
        $space = 0;
        /** @var DateTime $d */
        foreach ($days as $d) {
            $space += $this->nameLength;
            $svg = new SVGText($d->format('d'), $space, $height);
            switch ($d->format('N') - 1) {
                case 5:
                    $svg->setStyle('fill', $colorSat);
                    break;
                case 6:
                    $svg->setStyle('fill', $colorSun);
                    break;
                default:
                    $svg->setStyle('fill', $color);
                    break;
            }
            $doc->addChild($svg);
            $space += $this->nameLength;
        }
    }
}
