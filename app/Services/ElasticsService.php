<?php

namespace App\Services;
use Elasticsearch\ClientBuilder;

class ElasticsService
{
    private $client;

    public function __construct()
    {
        $hosts = config('database.elasticsearch.hosts');
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function getClient()
    {
        return $this->client;
    }

    public function search($params)
    {
        return $this->client->search($params);
    }
}

