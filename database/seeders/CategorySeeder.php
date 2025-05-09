<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Proteins',     'parent_category_id' => null],
            ['name' => 'Amino Acids',  'parent_category_id' => null],
            ['name' => 'Creatine',     'parent_category_id' => null],
            ['name' => 'Pre-workout',  'parent_category_id' => null],
            ['name' => 'Post-workout', 'parent_category_id' => null],
            ['name' => 'Weight Loss',  'parent_category_id' => null],
            ['name' => 'Vitamins',     'parent_category_id' => null],
        ]);
    }
}
