<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Home Page Slider (hardcoded — no admin panel)
    |--------------------------------------------------------------------------
    */
    'slider' => [
        [
            'image' => 'images/slider/slide-1.jpg',
            'eyebrow' => 'New Season',
            'title' => 'Discover Premium Fashion',
            'subtitle' => 'Up to 40% off selected styles',
            'link' => '/shop',
            'link_text' => 'Shop Now',
        ],
        [
            'image' => 'images/slider/slide-2.jpg',
            'eyebrow' => 'Women\'s Collection',
            'title' => 'Trending Looks This Week',
            'subtitle' => 'Fresh arrivals every day',
            'link' => '/category/womens-clothing',
            'link_text' => 'Explore Women',
        ],
        [
            'image' => 'images/slider/slide-3.jpg',
            'eyebrow' => 'Tech Deals',
            'title' => 'Electronics & Gadgets',
            'subtitle' => 'Best prices on top brands',
            'link' => '/category/consumer-electronics',
            'link_text' => 'Shop Electronics',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Category card fallback images (when category has no image)
    |--------------------------------------------------------------------------
    */
    'category_images' => [
        'womens-clothing' => 'https://images.unsplash.com/photo-1483985988350-763728e1935b?w=400&h=300&fit=crop',
        'mens-clothing' => 'https://images.unsplash.com/photo-1490114538077-0a7f8ddb731e?w=400&h=300&fit=crop',
        'phones-accessories' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop',
        'computer-office' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop',
        'consumer-electronics' => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=400&h=300&fit=crop',
        'jewelry-watches' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844cfe?w=400&h=300&fit=crop',
        'bags-shoes' => 'https://images.unsplash.com/photo-1548036328-c9fa89d6e08d?w=400&h=300&fit=crop',
    ],

];
