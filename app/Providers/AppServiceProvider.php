<?php

namespace App\Providers;

use Elastic\Elasticsearch\Client;
use App\Articles\ArticleRepository;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;
use Elastic\Elasticsearch\ClientBuilder;
use App\Articles\ElasticSearchRepository;
use App\Articles\EloquentSearchRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, GuzzleClient::class);

        $this->app->bind(ArticleRepository::class, function ($app) {
            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            if (! config('services.search.enabled')) {
                return new EloquentSearchRepository();
            }

            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
