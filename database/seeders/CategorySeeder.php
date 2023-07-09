<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(['name' => 'Clothing'], ['name' => 'Handy']);
        foreach ($categories as $category)
        {
            $id = Category::create(['name' => $category['name']]);
        }
    }
    
}
