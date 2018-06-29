<?php

return array(

    'app_path' => 'app',
    'app_url' => 'http://localhost/app/htdocs',

    //'wp-api-url' => 'https://demo.wp-api.org/wp-json',
    'wp-api-url' => 'http://localhost/wordpress/wp-json',

    'routing-type' => [
        'posts' => '/wp/v2/posts',
        'categories' => '/wp/v2/categories',
        'pages' => '/wp/v2/pages',
        'taxonomies' => '/wp/v2/taxonomies',
        'media' => '/wp/v2/media',
        'videos' => '/wp/v2/videos',
    ],

    'routes' => [
        'search' => \Frontend\Controller\SearchController::class,
    ]
);