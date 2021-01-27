<?php

if (!function_exists('backOrHome')) {

    /**
     * Returns the url of the previous page in case it's different
     * from the actual one, or returns the home's url.
     * 
     * @return string
     */
    function backOrHome()
    {
        return url()->previous() !== url()->full() ? url()->previous() : route('home');
    }

    /**
     * Returns the given number as an ordinal string (1st, 2nd, 3rd, 4th, etc.)
     * 
     * @param int $number
     * @return string
     */
    function ordinal($number)
    {
        $endings = ['th','st','nd','rd','th','th','th','th','th','th'];
        return ((($number % 100) >= 11) && (($number % 100) <= 13)) ? "{$number}th" : $number . $endings[$number %10];
    }
}