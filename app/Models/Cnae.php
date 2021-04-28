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

    /**
     * Get informations specific cnea with code cnae
     *
     * @param $code
     * @return mixed
     */
    public function getSpecificCnae($code)
    {
        return $this->select(
            'codigo',
            'nome',
        )
            ->where('codigo', $code);
    }



}
