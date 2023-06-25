<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
        Validator::replacer('required', function ($message, $attribute, $rule, $parameters) {
            if (str_contains($message, ':nth') && preg_match("/\.(\d+)\./", $attribute, $match)) {
                $message =  str_replace(":prop", explode(".", $attribute)[2], $message);
                return str_replace(":nth", $match[1] + 1, $message);
            }

            return $message;
        });
    }
}
