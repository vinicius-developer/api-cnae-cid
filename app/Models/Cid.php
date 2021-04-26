<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cid extends Model 
{
 
    protected $table = 'cids';

    protected $primaryKey = 'id_cid';

    public $timestamps = false;
    
    protected $fillable = [
        'codigo',
        'nome'
    ];
}
