<?php

namespace Database\Seeders;

use App\Models\ParticipanteProyecto;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantesProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participantes_proyectos')->truncate();

        $users = User::all();
        $proyectos = Proyecto::count();

        foreach ($users as $user) {
            $numRandom = rand(0, 2);

            for ($i = 0; $i < $numRandom; $i++) {
                $participanteProyecto = new ParticipanteProyecto();
                $participanteProyecto->user_id = $user->id;
                $participanteProyecto->proyecto_id = rand(1, $proyectos);
                $participanteProyecto->save();
            }


        }
    }
}
