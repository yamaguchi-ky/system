<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use App\Models\companies;


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

    public function companies(){
        return $this->belongsTo(companies::class,'id');
    }




}
