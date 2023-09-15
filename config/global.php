<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Variables
    |--------------------------------------------------------------------------
    |
    |
    */

    'paginate_per_page' => env('PAGINATE_PER_PAGE', 10),

    'super_user' => env('SUPER_USER', 'pateldarpan4295@gmail.com'),

    'super_pass' => env('SUPER_PASS', '$2y$10$DW8z2lkFAupglyB.00HSg.OoUuPOnECs12xye00/ktOCZZspFuUwm'),
    //12345678

    'default_logo' => env('APP_URL').'/public/assets/img/dashboard/logos/logo/bulkit-red.png',

    'default_favicon' => env('APP_URL').'/public/assets/img/dashboard/logos/logo/bulkit-red.png',

    'default_user_image' => env('APP_URL').'/public/assets/img/user.jpg',

    'datepicker_date_placeholder' => env('DATEPICKER_DATE_PLACEHOLDER', 'DD/MM/YYYY'),
    'datepicker_date_format' => env('DATEPICKER_DATE_FORMAT', 'dd/mm/yyyy'),

    'date_format' => env('DATE_FORMAT', 'm/d/Y'),
    'time_format' => env('TIME_FORMAT', 'g:i A'),
    'datetime_format' => env('DATE_FORMAT', 'm/d/Y').' '.env('TIME_FORMAT', 'g:i A'),

    'db_date_format' => env('DB_DATE_FORMAT', 'Y-m-d'),
    'db_time_format' => env('DB_TIME_FORMAT', 'H:i:s'),
    'db_datetime_format' => env('DB_DATE_FORMAT', 'Y-m-d').' '.env('DB_TIME_FORMAT', 'H:i:s'),
];
