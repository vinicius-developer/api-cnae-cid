<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelacaoCnaeCid extends Model
{
    protected $table = 'relacao_cnae_cids';

    protected $primaryKey = 'id_relacao_cnae_cid';

    public $fillabel = [
        'id_cnae',
        'id_cid'
    ];
}
