<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cinematic mosaic — up to 4 looping background videos
    |--------------------------------------------------------------------------
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
            'catalog'          => [
                'model'   => 'H-Frame Broiler',
                'gallery' => [
                    'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1600&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1612170153139-6f881ff067e0?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1553531009-c4605ebe6122?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1589923188900-85dae523342b?w=1400&q=85&auto=format&fit=crop',
                ],
                'video' => env('MI_BROILER_VIDEO', ''),
                'poster'=> 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1600&q=85&auto=format&fit=crop',
            ],
        ],
        'layer' => [
            'slug'             => 'layer',
            'calc_type'        => 'layer',
            'product_category' => 'cages',
            'project_category' => 'layer',
            'accent'           => '#C8102E',
            'catalog'          => [
                'model'   => 'A-Type Layer',
                'gallery' => [
                    'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=1600&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1612170153139-6f881ff067e0?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1589923188900-85dae523342b?w=1400&q=85&auto=format&fit=crop',
                ],
                'video' => env('MI_LAYER_VIDEO', ''),
                'poster'=> 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=1600&q=85&auto=format&fit=crop',
            ],
        ],
        'construction' => [
            'slug'             => 'construction',
            'calc_type'        => null,
            'product_category' => 'concrete',
            'project_category' => null,
            'work_type'        => 'civil',
            'accent'           => '#C8102E',
            'catalog'          => [
                'model'   => 'Turnkey House',
                'gallery' => [
                    'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1400&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1400&q=85&auto=format&fit=crop',
                ],
                'video' => env('MI_BUILD_VIDEO', ''),
                'poster'=> 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=85&auto=format&fit=crop',
            ],
        ],
    ],
];
