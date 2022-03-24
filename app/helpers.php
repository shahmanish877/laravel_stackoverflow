<?php
global $user_types;

if (! function_exists('str_ordinal')) {
    function str_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = ['th','st','nd','rd','th','th','th','th','th','th'];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }

        echo number_format($number) . $suffix;
    }
}
