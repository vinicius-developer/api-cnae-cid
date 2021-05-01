<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse as Json;
use App\Traits\ResponseMessage;
use App\Models\RelacaoCnaeCid;
use App\Traits\BuildCodes;
use App\Models\Cnae;
use Exception;

/**
 * Class CnaeController
 * @package App\Http\Controllers
 */
class CnaeController extends Controller
{
    use ResponseMessage, BuildCodes;


    private $cnae;
    private $relacao_cnae_cid;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cnae = new Cnae();
        $this->relacao_cnae_cid = new RelacaoCnaeCid();
    }

    /**
     *
     * Get specific cnae by code
     *
     * @param string $rawCnae
     * @return Json
     */
    public function find(string $rawCnae): Json
    {
        $cnae = $this->buildCnae($rawCnae);

        $result = $this->cnae->getSpecificCnae($cnae)->first();

        if($result->count()) {

            return $this->successMessage($result);

        } else {

            return $this->errorMessage($result, 404);

        }
    }

    /**
     * Get all cid by specific cnae
     *
     * @param string $rawCnae
     * @return Json
     */
    public function getCidsByCnae(string $rawCnae): Json
    {
        try {

            $cnae = $this->buildCnae($rawCnae);

            $idCnae = $this->cnae->getIdByCode($cnae);

            $cids = $this->relacao_cnae_cid->getAllCidsBySpecificCnae($idCnae)->get();

        } catch (Exception $e) {

            return $this->errorMessage(['error' => 'Não foi possivel encontrar o cnae'], 422);

        }

        return $this->successMessage($cids);
    }
}
