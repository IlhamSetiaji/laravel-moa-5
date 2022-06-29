<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Horror'
            ],
            [
                'name' => 'Romance'
            ],
            [
                'name' => 'Komedi'
            ],
            [
                'name' => 'Sci-fi'
            ],
            [
                'name' => 'Slice of life'
            ],
        ])->each(function($genres){
            Genre::create($genres);
        });
    }
}
