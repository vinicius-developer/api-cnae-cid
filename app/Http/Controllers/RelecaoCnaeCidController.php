<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cid;
use App\Models\Cnae;
use App\Traits\BuildCodes;
use App\Models\RelacaoCnaeCid;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse as Json;

/**
 * Class RelecaoCnaeCidController
 * @package App\Http\Controllers
 */
class RelecaoCnaeCidController extends Controller
{
    use ResponseMessage, BuildCodes;

    private $cid;
    private $cnae;
    private $relacao_cnae_cid;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cid = new Cid();
        $this->cnae = new Cnae();
        $this->relacao_cnae_cid = new RelacaoCnaeCid();
    }

    /**
     * Exists relationship cnae, cid
     *
     * @param string $rawCnae
     * @param string $rawCid
     * @return Json
     */
    public function exists(string $rawCnae, string $rawCid): Json
    {
        $cnae = $this->buildCnae($rawCnae);

        $cid = $this->buildCid($rawCid);

        try {
            $idCid = $this->cid->getIdByCode($cid);
        } catch (Exception $e) {
            return $this->errorMessage(['error' => 'CID não existe'], 422);
        }

        try {
            $idCnae = $this->cnae->getIdByCode($cnae);
        } catch (Exception $e) {
            return $this->errorMessage(['error' => 'CNAE não existe'], 422);
        }

        $relationExists = $this->relacao_cnae_cid->relationshipExists($idCnae, $idCid);

        return $this->successMessage(['exists' => $relationExists]);

    }


}
