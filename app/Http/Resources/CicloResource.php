<?php

namespace App\Http\Resources;

use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CicloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $padre=parent::toArray($request);
        $familiaProfesional = $this->familiaProfesional;
        $familia=
        [
            "familia_id"=> [
              "id"=>$familiaProfesional->id,
              "codigo"=>$familiaProfesional->codigo ,
              "nombre"=>$familiaProfesional->nombre
            ]
        ];
        unset($padre['created_at']);
        unset($padre['updated_at']);

        return array_merge(
            $padre,
            $familia,
            ['proyectos' => $this->proyectos],
            ['familia_profesional' => $this->familiaProfesional]
        );
    }
}
