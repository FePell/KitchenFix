<?php

use Illuminate\Support\Str;

/**
 * ATTENZIONE:
 * - NON modificare connect.php sul server
 * - NON usare env() per il database
 * - Connessione DB definita ESCLUSIVAMENTE qui
 */

// ====== CARICAMENTO CONNECT SERVER ======

$serverConnect = '/home/grp_67/www/include/connect.php';

if (file_exists($serverConnect)) {
    require_once $serverConnect; // server (definisce $HOST, $DB, $USER, $PASSWORD)
} else {
    // fallback locale
    $HOST = '127.0.0.1';
    $DB = 'kitchenfix';   // <-- cambia con il tuo DB locale
    $USER = 'root';
    $PASSWORD = '';
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection
    |--------------------------------------------------------------------------
    */
    'default' => 'mariadb',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    */
    'connections' => [

        /*
        |--------------------------------------------------------------------------
        | MariaDB (USATA DAL PROGETTO)
        |--------------------------------------------------------------------------
        */
        'mariadb' => [
            'driver' => 'mariadb',
            'url' => null,
            'host' => $HOST,
            'port' => 3306,
            'database' => $DB,
            'username' => $USER,
            'password' => $PASSWORD,
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                // eventuali opzioni SSL se richieste
            ]) : [],
        ],

        /*
        |--------------------------------------------------------------------------
        | SQLite (NON usata)
        |--------------------------------------------------------------------------
        */
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    */
    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis (NON rilevante per il progetto)
    |--------------------------------------------------------------------------
    */
    'redis' => [

        'client' => 'phpredis',

        'options' => [
            'cluster' => 'redis',
            'prefix' => Str::slug('laravel', '_') . '_database_',
        ],

        'default' => [
            'host' => '127.0.0.1',
            'password' => null,
            'port' => 6379,
            'database' => 0,
        ],

        'cache' => [
            'host' => '127.0.0.1',
            'password' => null,
            'port' => 6379,
            'database' => 1,
        ],

    ],

];
