<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamiliaProfesionalResource;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class FamiliaProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index(request $request)
=======
    public function index(Request $request)
>>>>>>> 6b46599a89b62efe7ab07ca000b22924652271a3
    {
        return FamiliaProfesionalResource::collection(
            FamiliaProfesional::orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
            ->paginate($request->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $familiaProfesional = json_decode($request->getContent(),true);

        $familiaProfesional = FamiliaProfesional::create($familiaProfesional);

        return new FamiliaProfesionalResource(($familiaProfesional));
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional)
    {
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $familiaProfesionalData = json_decode($request->getContent(), true);
        $familiaProfesional->update($familiaProfesionalData);

        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamiliaProfesional $familiaProfesional)
    {
        try {
            $familiaProfesional->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
