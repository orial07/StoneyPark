<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Stoney Park Campgrounds | Campground near Calgary, Alberta", // set false to total remove
            'titleBefore'  => "Visit us by making a reservation", // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => "Are you looking for a place to camp near Calgary, Alberta, Stoney Campgrounds is now opening the park for the first time in 20 years! Reserve now", // set false to total remove
            'separator'    => ' | ',
            'keywords'     => ["Stoney", "Park", "Campgrounds", "Campground", "campers", "reservation"],
            'canonical'    => null, // Set null for using Url::current(), set false to total remove
            'robots'       => "all", // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Stoney Park Campgrounds | Campground near Calgary, Alberta', // set false to total remove
            'description' => "Are you looking for a place to camp near Calgary, Alberta, Stoney Campgrounds is now opening the park for the first time in 20 years! Reserve now", // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => "Stoney Park Campgrounds",
            'images'      => [
                'https://stoneycampgrounds.com/img/favicon.png'
            ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => false, // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
