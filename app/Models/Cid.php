<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Cid
 * @package App\Models
 */
class Cid extends Model
{
    protected $table = 'cids';

    protected $primaryKey = 'id_cid';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nome'
    ];

    /**
     * Get id cid with code
     *
     * @param string $code
     * @return mixed
     */
    public function getIdByCode(string $code)
    {
        return $this->select(
            'id_cid'
        )
            ->where('codigo', $code)
            ->first()
            ->id_cid;
    }

    /**
     * Get specific cid with code
     *
     * @param string $code
     * @return mixed
     */
    public function getSpecificCid(string $code)
    {

        return $this->select(
            'codigo',
            'nome'
        )
            ->where('codigo', $code);
    }

    /**
     * Recebe um array de CIDS e retorna os
     * ids referentes a eles
     *
     * @param array $cids
     * @return mixed
     */
    public function getIdsByCodeArray(array $cids)
    {
        return $this->select(
            'id_cid'
        )
            ->wherein('codigo', $cids);
    }

}
