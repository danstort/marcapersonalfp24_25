<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),
            ['actividades_estudiante' => $this->actividadesComoEstudiante],
            ['actividades_docente' => $this->actividadesComoDocente],
            ['competencias' => $this->competencias],
            ['curriculo' => $this->curriculo],
            [
                'ciclos' => $this->ciclos->map(function ($ciclo) {
                    return [
                        'id' => $ciclo->id,
                        'codCiclo' => $ciclo->codCiclo,
                        'nombre' => $ciclo->nombre,
                        'familia_profesional' => $ciclo->familiaProfesional,
                    ];
                }),

            ],
            ['proyectos' => $this->proyectos],
            [
                'idiomas' => $this->idiomas->map(function ($idioma) {
                    return [

                        'alpha2' => $idioma->alpha2,
                        'native_name' => $idioma->native_name,
                        'nivel' => $idioma->pivot->nivel,
                        'certificado' => $idioma->pivot->certificado,
                    ];
                }),
            ],

        );
    }
}
