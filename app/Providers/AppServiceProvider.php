<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Zalo\Zalo;
use Zalo\ZaloEndpoint;
use Zalo\ZaloConfig;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $zalo = new Zalo(ZaloConfig::getInstance()->getConfig());
        $helper = $zalo -> getRedirectLoginHelper();
        $callBackUrl = "https://software.gco.vn/";
        $accessToken = $helper->getAccessToken($callBackUrl); // get access token
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
