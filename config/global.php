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

    'default_pfp' => env('APP_URL').'/public/assets/img/default-pfp.png',

    'datepicker_date_placeholder' => env('DATEPICKER_DATE_PLACEHOLDER', 'DD/MM/YYYY'),
    'datepicker_date_format' => env('DATEPICKER_DATE_FORMAT', 'dd/mm/yyyy'),

    'date_format' => env('DATE_FORMAT', 'd/m/Y'),
    'time_format' => env('TIME_FORMAT', 'g:i A'),
    'datetime_format' => env('DATE_FORMAT', 'd/m/Y').' '.env('TIME_FORMAT', 'g:i A'),

    'db_date_format' => env('DB_DATE_FORMAT', 'Y-m-d'),
    'db_time_format' => env('DB_TIME_FORMAT', 'H:i:s'),
    'db_datetime_format' => env('DB_DATE_FORMAT', 'Y-m-d').' '.env('DB_TIME_FORMAT', 'H:i:s'),

    "creatorName" => "PIXINVENT",
    "creatorUrl" => "https://pixinvent.com",
    "templateName" => env('APP_NAME', "Frest"),
    "templateSuffix" => "Bootstrap Admin Template",
    "templateVersion" => "1.0.0",
    "templateFree" => false,
    "templateDescription" => "Start your development with a Dashboard for Bootstrap 5",
    "templateKeyword" => "dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5",
    "licenseUrl" => "https://themeforest.net/licenses/standard",
    "livePreview" => "https://demos.pixinvent.com/frest-html-admin-template/landing/",
    "productPage" => "https://1.envato.market/frest_admin",
    "support" => "https://pixinvent.ticksy.com/",
    "moreThemes" => "https://1.envato.market/pixinvent_portfolio",
    "documentation" => "https://demos.pixinvent.com/frest-html-admin-template/documentation/laravel-introduction.html",
    "generator" => "",
    "changelog" => "https://demos.pixinvent.com/frest/changelog.html",
    "repository" => "https://github.com/pixinvent/frest-admin-dashboard-template-src",
    "gitAuthor" => "pixinvent",
    "gitRepo" => "frest-admin-dashboard-template-src",
    "facebookUrl" => "https://www.facebook.com/pixinvents/",
    "twitterUrl" => "https://twitter.com/pixinvents",
    "githubUrl" => "https://github.com/pixinvent",
    "dribbbleUrl" => "https://dribbble.com/pixinvent",
    "instagramUrl" => "https://www.instagram.com/pixinvents/"
];
