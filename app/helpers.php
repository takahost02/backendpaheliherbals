<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

if (! function_exists('mlm_setting')) {
    function mlm_setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember(
            "mlm_setting_{$key}",
            3600,
            fn () => DB::table('mlm_settings')
                ->where('name', $key)
                ->value('value') ?? $default
        );
    }
}
