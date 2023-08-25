<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\testUsers;

class companies extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'id',
        'company_name',
        'street_adress',
        'representative_name'
    ];

    public function testUsers(){
        return $this->hasMany(testUsers::class,'company_id');
    } 



}
