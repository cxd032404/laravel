<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class SwooleTest2Model extends Model
{
    protected $table = "test_table";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $connection = "db_st2";
}
