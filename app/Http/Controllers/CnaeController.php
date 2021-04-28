<?php

namespace App\Http\Controllers;

use App\Models\Cnae;
use App\Traits\ResponseMessage;

class CnaeController extends Controller
{
    use ResponseMessage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $cnae;

    public function __construct()
    {
        $this->cnae = new Cnae();
    }

    public function find($code)
    {
        $result = $this->cnae->getSpecificCnae($code)->get();

        if(count($result)) {
            return $this->successMessage($result);
        } else {
            return $this->errorMessage($result, 404);
        }
    }
}
