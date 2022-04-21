<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UrlChecksControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $faker = Factory::create();
        $parsedUrl = parse_url($faker->url);
        $url = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";
        $data = [
            'name' => $url,
            'created_at' => Carbon::now()->toDateTimeString(),

        ];

        $urlId = DB::table('urls')->insertGetId($data);

        $testedHtml = file_get_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'Fixtures', 'test-page.html']));

        if ($testedHtml === false) {
            throw new \Exception('Не удалось загрузить контент из тестовой страницы');
        }

        Http::fake([$url => Http::response($testedHtml)]);

        $expectedData = [
            'url_id' => $urlId,
            'status_code' => 200,
            'h1' => 'test h1',
            'description' => 'test description',
            'keywords' => 'test, keywords'
        ];

        $response = $this->post(route('url_checks.store', $urlId));
        $this->assertDatabaseHas('url_checks', $expectedData);
        $response->assertStatus(302);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

}
