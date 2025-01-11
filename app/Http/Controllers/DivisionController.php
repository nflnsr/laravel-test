<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function get()
    {
        $division = Division::all();

        $response = [
            'divisions' => DivisionResource::collection($division)->resolve()
        ];
        
        return ResponseHelper::buildResponse(200, 'success', 'get division success', $response);
    }
}
