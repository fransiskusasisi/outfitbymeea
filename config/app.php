<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    */
    'name' => env('APP_NAME', 'Outfitbymee'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    */
    'env' => env('APP_ENV', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    */
    'debug' => (bool) env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    */
    'url' => env('APP_URL', 'http://127.0.0.1:8000'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    | Zona waktu disesuaikan ke Asia/Jakarta (WIB)
    */
    'timezone' => 'Asia/Jakarta',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    | Default bahasa diubah ke "id" (Indonesia)
    */
    'locale' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    */
    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    | Faker locale disesuaikan biar data palsu pakai format Indonesia
    */
    'faker_locale' => 'id_ID',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    */
    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    */
    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Yajra\DataTables\DataTablesServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    */
    'aliases' => Facade::defaultAliases()->merge([
        // Tambahkan alias tambahan di sini bila perlu
        // 'PDF' => Barryvdh\DomPDF\Facade\Pdf::class,  ← nanti bisa dipakai kalau kamu mau cetak PDF
    ])->toArray(),

];