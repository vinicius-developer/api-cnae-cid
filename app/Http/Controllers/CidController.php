<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse as Json;
use App\Traits\ResponseMessage;
use App\Models\RelacaoCnaeCid;
use App\Traits\BuildCodes;
use App\Models\Cid;
use Exception;

/**
 * Class CidController
 * @package App\Http\Controllers
 */
class CidController extends Controller
{
    use ResponseMessage, BuildCodes;

    private $cid;
    private $relacao_cnae_cid;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cid = new Cid();
        $this->relacao_cnae_cid = new RelacaoCnaeCid();
    }

    /**
     * Find specific cid
     *
     * @param string $rawCid
     * @return Json
     */
    public function find(string $rawCid): Json
    {
        $cid = $this->buildCid($rawCid);

        $result = $this->cid->getSpecificCid($cid)->first();

        if($result->count()) {

            return $this->successMessage($result);

        } else {

            return $this->errorMessage($result, 404);

        }
    }

    /**
     * Get all cnaes by specific cid
     *
     * @param string $rawCid
     * @return Json
     */
    public function getCnaesByCId(string $rawCid): Json
    {
        $cid = $this->buildCid($rawCid);

        try {

            $idCid = $this->cid->getIdByCode($cid);

            $cnaes = $this->relacao_cnae_cid->getAllCnaeBySpecificCid($idCid)->get();

        } catch (Exception $e) {

            dd($e->getMessage());

            return $this->errorMessage(['error' => "Não foi possível encontrar cnaes relacionados a esse cid"], 422);

        }

        return $this->successMessage($cnaes);
    }


}
