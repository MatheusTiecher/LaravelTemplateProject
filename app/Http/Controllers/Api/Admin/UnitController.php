<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use App\Traits\ResponseCreator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        if (Gate::denies('has-permission', 'unit-create')) {
            throw new AuthorizationException();
        }

        $unit = Unit::create($request->validated());

        return $this->createResponseSuccess($unit, 201, 'Unidade criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);

        return $this->createResponseSuccess($unit, 200, 'Unidade recuperada com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, string $id)
    {
        if (Gate::denies('has-permission', 'unit-update')) {
            throw new AuthorizationException();
        }

        $unit = Unit::findOrFail($id);

        $unit->update($request->validated());
        return $this->createResponseSuccess([], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::denies('has-permission', 'unit-delete')) {
            throw new AuthorizationException();
        }

        $unit = Unit::findOrFail($id);

        $unit->delete();
        return $this->createResponseSuccess([], 204);
    }
}
