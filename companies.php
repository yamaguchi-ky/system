<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'street_adress',
        'representative_name'
    ];


}
