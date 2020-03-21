<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\SwooleTestModel as SModel;
use App\Models\Test\SwooleTest2Model as S2Model;
use Illuminate\Support\Facades\Redis;
use Elasticsearch\ClientBuilder;



class IndexController extends Controller
{
    public function hello()
    {
        $sModel = new SModel();
        $s2Model = new S2Model();
        $s1 = ($sModel->get()->toArray());
        $s2 = ($s2Model->get()->toArray());
        $redis  = Redis::connection("default");
        $redis_key = "redis-test";
        $r =  $redis->incrBy($redis_key,rand(1,9));
        $client = ClientBuilder::create()->setHosts(['127.0.0.1:9200'])->build();

        $pa =
            [
                'index'=>'test_index',
                'type'=>'test_type',
                'body'=>
                    ['query'=>
                        ['bool'=>
                            ['must'=>
                                ['multi_match'=>
                                    ['query'=>1,'operator'=>'AND']
                                ]
                            ]
                        ]
                    ]
            ];
        $search_return = json_decode(json_encode($client->search($pa)),true);

        return response()->json(['s1'=>$s1,'s2'=>$s2,'redis'=>$r,'search'=>$search_return],200);
    }
}
