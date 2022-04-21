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
        $urls = [];
        $url_checks = [];
        $faker = Factory::create();

        for ($url_count = 1; $url_count <= 50; $url_count++) {
            $parsedUrl = parse_url($faker->url);
            $url = "{$parsedUrl['scheme']}://$url_count{$parsedUrl['host']}";
            $urls[] = [
                'id' => $url_count,
                'name' => $url,
                'created_at' => $faker->dateTime
            ];
            for ($url_checks_count = 1; $url_checks_count <= 50; $url_checks_count++) {
                $url_checks[] = [
                    'url_id' => $url_count,
                    'status_code' => 200,
                    'h1' => $faker->text(20),
                    'description' => $faker->text(50),
                    'keywords' => str_replace(' ', ',', $faker->text(50)),
                    'created_at' => $faker->dateTime,
                    'updated_at' => $faker->dateTime,

                ];
            }

        }

        DB::table('urls')->insert($urls);
        DB::table('url_checks')->insert($url_checks);
    }
}
