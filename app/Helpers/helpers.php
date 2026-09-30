<?php

use App\Models\Konfig;

if (!function_exists('konfig')) {

    function konfig()
    {
        return cache()->rememberForever('konfig', function () {
        $data = \App\Models\Konfig::first();

        return $data ? $data->toArray() : [];
         });
    }
}