<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdministradorResource;
use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return AdministradorResource::collection(
            Administrador::orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
            ->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $administrador = json_decode($request->getContent(), true);

        $administrador = Administrador::create($administrador);

        return new AdministradorResource($administrador);
    }


    public function show(Administrador $administrador)
    {
        return new AdministradorResource($administrador);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        $administradorData = json_decode($request->getContent(), true);
        $administrador->update($administradorData);

        return new AdministradorResource($administrador);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        try {
            $administrador->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
    
}
