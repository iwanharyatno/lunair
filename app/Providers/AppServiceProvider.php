<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use Midtrans\Config as MidtransConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Storage::extend('google', function($app, $config) {
            $options = [];

            if (!empty($config['teamDriveId'] ?? null)) {
                $options['teamDriveId'] = $config['teamDriveId'];
            }

            if (!empty($config['sharedFolderId'] ?? null)) {
                $options['sharedFolderId'] = $config['sharedFolderId'];
            }

            $client = new \Google\Client();
            $client->setClientId($config['client_id']);
            $client->setClientSecret($config['client_secret']);
            $client->refreshToken($config['refresh_token']);
            
            $service = new \Google\Service\Drive($client);
            $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
            $driver = new \League\Flysystem\Filesystem($adapter);

            return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
        });

        MidtransConfig::$serverKey = config('midtrans.serverKey');
        MidtransConfig::$isProduction = false;
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
        MidtransConfig::$overrideNotifUrl = config('midtrans.notif_url');
    }
}
