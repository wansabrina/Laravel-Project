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
        Category::create([
            'name' => "Machine Learning",
            'slug' => "machine-learning",
            'color' => "red"
        ]);
        
        Category::create([
            'name' => "Web Programming",
            'slug' => "web-programming",
            'color' => "blue"
        ]);
        
        Category::create([
            'name' => "Data Science",
            'slug' => "data-science",
            'color' => "green"
        ]);
        
        Category::create([
            'name' => "Cloud Computing",
            'slug' => "cloud-computing",
            'color' => "yellow"
        ]);
        
        Category::create([
            'name' => "Cyber Security",
            'slug' => "cyber-security",
            'color' => "purple"
        ]);             
    }
}
