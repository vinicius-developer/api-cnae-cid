<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cid;
use App\Models\Cnae;
use App\Traits\BuildCodes;
use App\Models\RelacaoCnaeCid;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;;
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
            return $this->errorMessage(['error' => 'CID não existe'], 403);
        }

        try {
            $idCnae = $this->cnae->getIdByCode($cnae);
        } catch (Exception $e) {
            return $this->errorMessage(['error' => 'CNAE não existe'], 403);
        }

        $relationExists = $this->relacao_cnae_cid->relationshipExists($idCnae, $idCid);

        return $this->successMessage(['exists' => $relationExists]);

    }

    public function exists_group(Request $request)
    {
        $this->validate_exists_group($request);

        try {
            $cnaes = $this->cnae->getIdsByCodeArray($request->cnaes)
                ->get()
                ->pluck('id_cnae');

            $cids = $this->cid->getIdsByCodeArray($request->cid10)
                ->get()
                ->pluck('id_cid');

            $result = $this->relacao_cnae_cid
                ->relationshipExistsArrayCodeCid($cnaes, $cids);

        } catch(Exception $e) {
            return $this->errorMessage([
                'error' => "Não foi possível executar ação"
            ], 400);
        }

        return $this->successMessage([
            'label' => 'Relações',
            'total' => $result->count(),
            'relationship' => $result->get()
        ]);
    }

    public function validate_exists_group(Request $request)
    {
        $this->validate($request, [
            'cnaes' => 'required|array',
            'cid10' => 'required|array'
        ], [
            'cnaes.required' => 'É necessário os cnae(s) da empresa',
            'cnaes.array' => 'campo cnae precisa ser um array',
            'cid10.required' => 'É necessário inserir o campo cid10',
            'cid10.array' => 'campo cid10 precisa ser um array',
        ]);
    }


}
