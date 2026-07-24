<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cinematic mosaic — up to 4 looping background videos
    |--------------------------------------------------------------------------
    | Leave empty to auto-use the active hero slide video (split into 4 crops).
    | Absolute https URLs or /storage/... paths are both fine.
    */
    'mosaic_videos' => array_values(array_filter([
        env('MI_SERVICE_VIDEO_1'),
        env('MI_SERVICE_VIDEO_2'),
        env('MI_SERVICE_VIDEO_3'),
        env('MI_SERVICE_VIDEO_4'),
    ])),

    'pillars' => [
        'broiler' => [
            'slug'             => 'broiler',
            'calc_type'        => 'broiler',
            'product_category' => 'cages',
            'project_category' => 'broiler',
            'accent'           => '#C8102E',
        ],
        'layer' => [
            'slug'             => 'layer',
            'calc_type'        => 'layer',
            'product_category' => 'cages',
            'project_category' => 'layer',
            'accent'           => '#C8102E',
        ],
        'construction' => [
            'slug'             => 'construction',
            'calc_type'        => null,
            'product_category' => 'concrete',
            'project_category' => null,
            'work_type'        => 'civil',
            'accent'           => '#C8102E',
        ],
    ],
];
