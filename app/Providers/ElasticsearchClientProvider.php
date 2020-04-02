<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticsearchClientProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('elasticsearch', function () {
            return ClientBuilder::create()->setHosts(['127.0.0.1:9200'])->build();
            //return new ElasticsearchClient();
        });
    }

    public function provides()
    {
        return ['elasticsearch'];
    }

}
