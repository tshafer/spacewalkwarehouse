<?php

namespace App\Providers;

use Dropbox\Client as DropboxClient;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Dropbox\DropboxAdapter;
use League\Flysystem\Filesystem;
use Storage;

class DropboxFilesystemServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            $client = new DropboxClient($config['accessToken'], $config['appSecret']);

            return new Filesystem(new DropboxAdapter($client));
        });
    }


    public function register()
    {
        //
    }
}