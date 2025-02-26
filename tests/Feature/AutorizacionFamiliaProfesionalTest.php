<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\FamiliaProfesional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;

class AutorizacionFamiliaProfesionalTest extends TestCase
{
    // use RefreshDatabase;

    private static $apiurl_familia = '/api/v1/familias_profesionales';

    public function familiaProfesionalIndex() : TestResponse
    {
        return $this->get(self::$apiurl_familia);
    }

    public function familiaProfesionalShow() : TestResponse
    {
        $familiaProfesional = FamiliaProfesional::inRandomOrder()->first();
        return $this->get(self::$apiurl_familia . "/{$familiaProfesional->id}");
    }

    public function familiaProfesionalStore() : TestResponse
    {
        $data = [
            'codigo' => "ABC",
            'nombre' => "Familia Test",
        ];
        return $this->postJson(self::$apiurl_familia, $data);
    }

    public function familiaProfesionalUpdate($propio = false) : TestResponse
    {
        $familiaProfesional = $propio
        ? FamiliaProfesional::create(['codigo' => "ABC", 'nombre' => "Familia Test"])
            : FamiliaProfesional::inRandomOrder()->first();
        $data = [
            'codigo' => "ABC",
            'nombre' => "Familia Test",
        ];
        return $this->putJson(self::$apiurl_familia . "/{$familiaProfesional->id}", $data);
    }

    public function familiaProfesionalDelete($propio = false) : TestResponse
    {
        $familiaProfesional = $propio
            ? FamiliaProfesional::create(['codigo' => "ABC", 'nombre' => "Familia Test"])
            : FamiliaProfesional::inRandomOrder()->first();
        return $this->delete(self::$apiurl_familia . "/{$familiaProfesional->id}");
    }

    public function test_anonymous_can_access_curriculo_list_and_view()
    {
        $this->assertGuest();

        $response = $this->familiaProfesionalIndex();
        $response->assertStatus(200);

        $response = $this->familiaProfesionalShow();
        $response->assertStatus(200);

        $response = $this->familiaProfesionalStore();
        $response->assertUnauthorized();

        $response = $this->familiaProfesionalUpdate();
        $response->assertUnauthorized();

        $response = $this->familiaProfesionalDelete();
        $response->assertFound();

    }

    public function test_admin_can_CRUD_familiaProfesional()
    {
        $admin = User::where('email', env('ADMIN_EMAIL'))->first();
        $this->actingAs($admin);

        $response = $this->familiaProfesionalIndex();
        $response->assertSuccessful();

        $response = $this->familiaProfesionalShow();
        $response->assertSuccessful();

        $response = $this->familiaProfesionalStore();
        $response->assertSuccessful();

        $response = $this->familiaProfesionalUpdate();
        $response->assertSuccessful();

        $response = $this->familiaProfesionalDelete();
        $response->assertSuccessful();
    }



}
