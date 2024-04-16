<?php

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use Illuminate\Support\Facades\Storage;


if (!function_exists('storageExist')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function storageExist($file='a')
    {
        return Storage::exists($file);
        // return str_replace('_', ' ', $name);
    }
}
if (!function_exists('storageLink')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function storageLink($file='a')
    {
        if (storageExist($file??'a')) {
            return Storage::URL($file);
        } else {
            return null;
        }


        // return str_replace('_', ' ', $name);
    }
}

if (!function_exists('textArea')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function textArea($text)
    {
        try {
            $formattedText = nl2br($text);
            return $formattedText;
        } catch (\Throwable $th) {
            return '';
        }

    }
}



