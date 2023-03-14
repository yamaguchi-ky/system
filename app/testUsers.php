<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testUsers extends Model
{
    protected $table = 'test_users';

    protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];
}
