<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cnae extends Model
{
    protected $table = 'cnaes';

    protected $primaryKey = 'id_cnae';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nome'
    ];
}