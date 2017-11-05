<?php
$app_databases = [
    'default' => [
        'className' => 'Cake\Database\Connection',
        'driver' => 'Cake\Database\Driver\Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'projeto_coderace',
        'encoding' => 'utf8',
        'timezone' => 'UTC',
        'flags' => [],
        'cacheMetadata' => false,
        'log' => false,

        /**
         * Set identifier quoting to true if you are using reserved words or
         * special characters in your table or column names. Enabling this
         * setting will result in queries built using the Query Builder having
         * identifiers quoted when creating SQL. It should be noted that this
         * decreases performance because each query needs to be traversed and
         * manipulated before being executed.
         */
        'quoteIdentifiers' => false,

        /**
         * During development, if using MySQL < 5.6, uncommenting the
         * following line could boost the speed at which schema metadata is
         * fetched from the database. It can also be set directly with the
         * mysql configuration directive 'innodb_stats_on_metadata = 0'
         * which is the recommended value in production environments
         */
        //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],

        'url' => env('DATABASE_URL', null),
    ],
];
