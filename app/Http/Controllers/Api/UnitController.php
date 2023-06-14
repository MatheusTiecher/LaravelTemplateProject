<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Traits\ResponseCreator;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    use ResponseCreator;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $units = Unit::filter($request)
            ->sort($request)
            ->paginate($request->per_page ?? 10);

        return $this->createResponseSuccess($units, 200, 'Unidades recuperadas com sucesso.');
    }

    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);

        return $this->createResponseSuccess($unit, 200, 'Unidade recuperada com sucesso.');
    }
}
