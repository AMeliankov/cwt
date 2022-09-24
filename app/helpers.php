<?php

declare(strict_types=1);

if (! function_exists('format_date')) {
    function format_date($date) {
        return $date ? \Carbon\Carbon::create($date)->format('d.m.Y') : null;
    }
}

if (! function_exists('format_date_time')) {
    function format_date_time($date) {
        return $date ? \Carbon\Carbon::create($date)->format('d.m.Y H:m') : null;
    }
}
