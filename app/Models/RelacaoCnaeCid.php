<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RelacaoCnaeCid
 * @package App\Models
 */
class RelacaoCnaeCid extends Model
{
    protected $table = 'relacao_cnae_cids';

    protected $primaryKey = 'id_relacao_cnae_cid';

    public $fillabel = [
        'id_cnae',
        'id_cid'
    ];

    /**
     * Get all cids by specific cnae
     *
     * @param integer $id_cnae
     * @return mixed
     */
    public function getAllCidsBySpecificCnae(int $id_cnae)
    {
        return $this->select(
            'ci.codigo',
            'ci.nome'
        )
            ->join('cids as ci', 'ci.id_cid', '=', 'relacao_cnae_cids.id_cid')
            ->where('relacao_cnae_cids.id_cnae', $id_cnae);
    }

    /**
     * Get all cnaes by specific cid
     *
     * @param int $id_cid
     * @return mixed
     */
    public function getAllCnaeBySpecificCid(int $id_cid)
    {
        return $this->select(
            'cn.codigo',
            'cn.nome'
        )
            ->join('cnaes as cn', 'cn.id_cnae', '=', 'relacao_cnae_cids.id_cnae')
            ->where('relacao_cnae_cids.id_cid', $id_cid);
    }


    /**
     * check relationship exist
     *
     * @param int $id_cnae
     * @param int $id_cid
     * @return mixed
     */
    public function relationshipExists(int $id_cnae, int $id_cid)
    {
        return $this->where('id_cnae', $id_cnae)
            ->where('id_cid', $id_cid)
            ->exists();
    }

    /**
     * Recebe um array de ids referentes e CIDS
     * e um array de ids referentes a CNAES
     * retorna todos os resultados que forem relacionados
     *
     * @param $ids_cnaes
     * @param $ids_cids
     * @return mixed
     */
    public function relationshipExistsArrayCodeCid($ids_cnaes, $ids_cids)
    {
        return $this->select(
            'c.codigo as codigo_cnae',
            'ci.codigo as codigo_cid'
        )
            ->wherein('relacao_cnae_cids.id_cnae', $ids_cnaes)
            ->wherein('relacao_cnae_cids.id_cid', $ids_cids)
            ->join('cnaes as c', 'c.id_cnae', '=', 'relacao_cnae_cids.id_cnae')
            ->join('cids as ci', 'ci.id_cid', '=', 'relacao_cnae_cids.id_cid');
    }


}
