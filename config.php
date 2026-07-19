<?php

declare(strict_types=1);

return [
    'site_name'   => 'Wiki Arcana',
    'site_url'    => 'https://arcanada.wiki',
    'description' => 'Wiki Arcana is coming soon. No knowledge content is published yet.',
    'version'     => '2',

    'ga_id' => '', // Set the site-specific GA4 Measurement ID before enabling analytics.

    'default_lang'    => 'en',
    'supported_langs' => ['en', 'ru'],

    'paths' => [
        'content'   => __DIR__ . '/content',
        'pages'     => __DIR__ . '/pages',
        'templates' => __DIR__ . '/templates',
    ],

    'arcanada_url' => 'https://arcanada.ai',
];
