<?php
/**
 * post-google-news-sitemap config file
 * @package post-google-news-sitemap
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'post-google-news-sitemap',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/post-google-news-sitemap',
    '__files' => [
        'modules/post-google-news-sitemap'  => ['install', 'remove','update'],
        'theme/site/post/google-news'       => ['install', 'remove','update']
    ],
    '__dependencies' => [
        'post'
    ],
    '_services' => [],
    '_autoload' => [
        'classes' => [
            'PostGoogleNewsSitemap\\Controller\\SitemapController' => 'modules/post-google-news-sitemap/controller/SitemapController.php'
        ],
        'files' => []
    ],
    '_routes' => [
        'site' => [
            'sitePostGoogleNewsSitemap' => [
                'rule' => '/post/news.xml',
                'handler' => 'PostGoogleNewsSitemap\\Controller\\Sitemap::index'
            ]
        ]
    ]
];