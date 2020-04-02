<?php

namespace App\Services;
use Elasticsearch\ClientBuilder;

class ElasticsService
{
    private $client;
    protected $documents = [];

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

    /**
     * @function Name addDocument
     * @description 添加日志
     * @param array $document
     */
    public function addDocument(array $document)
    {
        $this->documents[] = $document;
    }

    /**
     * @function Name getDocuments
     * @description 获取所有已添加日志
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}

