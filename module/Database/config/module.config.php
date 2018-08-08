<?php

namespace Database;

return array(
    // Doctrine configuration
    'doctrine' => array(
        'configuration' => array(
            'orm_default' => array(
                'query_cache'       => 'filesystem',
                'result_cache'      => 'array',
                'metadata_cache'    => 'apcu',
                'hydration_cache'   => 'apcu',
                'generate_proxies' => getenv('APP_ENV') === 'development',
            ),
        ),
    ),
);


