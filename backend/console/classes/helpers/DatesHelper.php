<?php


namespace console\classes\helpers;


class DatesHelper
{
    /** Конвертация даты типа "5-июл.-2020" в timestamp
     * @param string $date
     * @return string|string[]|null
     */
    public static function dateToTimestamp(string $date): string
    {
        $search = [
            '-янв.-',
            '-февр.-',
            '-мар.-',
            '-апр.-',
            '-мая-',
            '-июн.-',
            '-июл.-',
            '-авг.-',
            '-сент.-',
            '-окт.-',
            '-ноя.-',
            '-дек.-',
        ];
        $replace = [
            ' January ',
            ' February ',
            ' March ',
            ' April ',
            ' May ',
            ' June ',
            ' July ',
            ' August ',
            ' September ',
            ' October ',
            ' November ',
            ' December ',
        ];
        $format_date = str_replace($search, $replace, $date);
        $string_date = strtotime($format_date);

        return (string)$string_date;
    }
}