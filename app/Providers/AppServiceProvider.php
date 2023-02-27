<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use stdClass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $email_files = Storage::allFiles("emails_content");
        $files = new stdClass;
        foreach ($email_files as $file) {
            $f = explode("/", $file);
            $file_name = str_replace(".txt", "", $f[array_key_last($f)]);
            $data = Storage::get($file);
            $files->{$file_name} = $data;
        }
        view()->share("emails_content", $files);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}