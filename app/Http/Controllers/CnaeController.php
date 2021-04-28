<?php

namespace App\Http\Controllers;

use App\Models\Cnae;
use App\Rule\TestRule;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function find(Request $request)
    {
        $this->validate($request, [
            "cnae" => ['required', new TestRule()]
        ]);


        $result = $this->cnae->getSpecificCnae($request->cnae)->first();

        if(count($result)) {
            return $this->successMessage($result);
        } else {
            return $this->errorMessage($result, 404);
        }
    }
}
