<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $urlIds = [];
        $urls = [];
        $faker = Factory::create();

        for ($url_count = 0; $url_count <= 10; $url_count++) {
            $parsedUrl = parse_url($faker->url);
            $urls[] = "https://{$parsedUrl['host']}";
        }

        foreach (array_unique($urls) as $url) {
            $urlsData = [
                'name' => $url,
                'created_at' => $faker->dateTime
            ];
            $urlIds[] = DB::table('urls')->insertGetId($urlsData);
        }

        foreach ($urlIds as $id) {
            for ($url_checks_count = 0; $url_checks_count <= 5; $url_checks_count++) {
                $urlChecksData = [
                    'url_id' => $id,
                    'status_code' => 200,
                    'title' => $faker->text(20),
                    'h1' => $faker->text(20),
                    'description' => $faker->text(50),
                    'keywords' => str_replace(' ', ',', $faker->text(50)),
                    'created_at' => $faker->dateTime,
                    'updated_at' => $faker->dateTime,

                ];
                DB::table('url_checks')->insert($urlChecksData);
            }
        }
    }
}
