<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use DiDom\Document;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UrlControllerTest extends TestCase
{
    private array $data;

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $faker = Factory::create();
        $url = parse_url($faker->url);
        $this->data = [
            'url' => [
                'name' => "{$url['scheme']}://{$url['host']}",
            ]
        ];
    }

    public function test_create()
    {
        $response = $this->get(route('urls.create'));
        $document = new Document($response->content());
        $action = optional($document->first('form'))->getAttribute('action');
        $this->assertEquals(route('urls.store'), $action);
    }

    public function test_index()
    {
        $response = $this->get(route('urls.index'));
        $document = new Document($response->content());
        $this->assertTrue($document->has('.site-list'));
    }

    public function test_store()
    {
        $response = $this->post(route('urls.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('urls', $this->data['url']);
    }

    public function test_show()
    {
        $this->data['url']['created_at'] = Carbon::now();
        $id = DB::table('urls')->insertGetId($this->data['url']);
        $response = $this->get(route('urls.show', ['id' => $id]));
        $document = new Document($response->content());
        $action = optional($document->first('form'))->getAttribute('action');
        $this->assertEquals(route('url_checks.store', $id), $action);
    }
}
