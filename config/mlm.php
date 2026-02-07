<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Binary Income Settings
    |--------------------------------------------------------------------------
    */

    'binary' => [

        // Income per matched pair
        'pair_income' => 750,

        // Max pairs per closing (AM / PM)
        'session_capping' => 2,

        // Daily max (calculated automatically = 2 × session)
        'daily_capping' => 4,

        // Closing times (for reference / UI)
        'closing_sessions' => ['AM', 'PM'],
    ],

];
