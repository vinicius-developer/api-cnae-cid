<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cnae
 * @package App\Models
 */
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
     * Get id with code cnae
     *
     * @param string $code
     * @return mixed
     */
    public function getIdByCode(string $code)
    {
        return $this->select('id_cnae')
            ->where('codigo', $code)
            ->first()
            ->id_cnae;
    }

    /**
     * Get information specific cnae with code cnae
     *
     * @param string $code
     * @return mixed
     */
    public function getSpecificCnae(string $code)
    {
        return $this->select(
            'codigo',
            'nome',
        )
            ->where('codigo', $code);
    }
}
