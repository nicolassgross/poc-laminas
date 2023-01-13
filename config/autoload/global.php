<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'driver' => 'pdo_mysql',
                    'charset' => 'utf8',
                    'host' => 'mysql_57',
                    'port' => 3306,
                    'user' => 'root',
                    'password' => 'unimestre',
                    'dbname' => 'doctrine',
                ],
            ],
        ],

        'migrations_configuration' => [
            'orm_default' => [
                'table_storage' => [
                    'table_name' => 'migrations',
                    'version_column_name' => 'version',
                    'version_column_length' => 255,
                    'executed_at_column_name' => 'executed_at',
                    'execution_time_column_name' => 'execution_time'
                ],

                'migrations_paths' => [
                    'Migrations' => 'migrations'
                ],

                'all_or_nothing' => true,
                'check_database_platform' => true,
                'organize_migrations' => 'none',
            ],
        ],
    ],
];
