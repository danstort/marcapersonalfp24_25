<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Idiomas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;

class AutorizacionIdiomaTest extends TestCase
{
    // use RefreshDatabase;

    private static $apiurl_idioma = '/api/v1/idiomas';

    public function idiomaIndex(): TestResponse
    {
        return $this->get(self::$apiurl_idioma);
    }

    public function idiomaShow(): TestResponse
    {
        $idioma = Idiomas::inRandomOrder()->first();
        return $this->get(self::$apiurl_idioma . "/{$idioma->id}");
    }

    public function idiomaStore(): TestResponse
    {
        $data = [
            'alpha2' => 'es',
            'alpha3t' => 'spa',
            'alpha3b' => 'spa',
            'english_name' => 'Spanish',
            'native_name'   => 'Español',
        ];
        return $this->postJson(self::$apiurl_idioma, $data);
    }

    public function idiomaUpdate($propio = false): TestResponse
    {
        $idioma = $propio
            ? Idiomas::create(['alpha2' => 'es', 'alpha3t' => 'spa',])
            : Idiomas::inRandomOrder()->first();
        $data = [
            'alpha2' => 'es',
            'alpha3t' => 'spa',
            'alpha3b' => 'spa',
            'english_name' => 'Spanish',
            'native_name'   => 'Español',
        ];
        return $this->putJson(self::$apiurl_idioma . "/{$idioma->id}", $data);
    }

    public function idiomaDelete($propio = false): TestResponse
    {
        $idioma = $propio
            ? Idiomas::create(['alpha2' => 'es', 'alpha3t' => 'spa',])
            : Idiomas::inRandomOrder()->first();
        return $this->delete(self::$apiurl_idioma . "/{$idioma->id}");
    }

    public function test_anonymous_can_access_curriculo_list_and_view()
    {
        $this->assertGuest();

        $response = $this->idiomaIndex();
        $response->assertStatus(200);

        $response = $this->idiomaShow();
        $response->assertStatus(200);

        $response = $this->idiomaStore();
        $response->assertUnauthorized();

        $response = $this->idiomaUpdate();
        $response->assertUnauthorized();

        $response = $this->idiomaDelete();
        $response->assertFound();
    }

    public function test_admin_can_CRUD_idioma()
    {
        $admin = User::where('email', env('ADMIN_EMAIL'))->first();
        $this->actingAs($admin);

        $response = $this->idiomaIndex();
        $response->assertSuccessful();

        $response = $this->idiomaShow();
        $response->assertSuccessful();

        $response = $this->idiomaStore();
        $response->assertSuccessful();

        $response = $this->idiomaUpdate();
        $response->assertSuccessful();

        $response = $this->idiomaDelete();
        $response->assertSuccessful();
    }
}
