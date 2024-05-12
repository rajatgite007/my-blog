<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Categories
        $categories = [
            'Technology',
            'Health & Wellness',
            'Travel',
            'Food & Recipes',
            'Lifestyle',
            'Fashion & Beauty',
            'Finance & Money Management',
            'Education',
            'Arts & Entertainment',
            'Sports & Fitness'
        ];

        foreach ($categories as $categoryName) {
            Category::factory()->create(['name' => $categoryName, 'slug' => generateSlug($categoryName)]);
        }

        // Tags
        $tags = [
            'TechNews',
            'HealthyLiving',
            'TravelTips',
            'Recipes',
            'FashionTrends',
            'PersonalFinance',
            'EducationalResources',
            'MovieReviews',
            'FitnessGoals',
            'DIYProjects'
        ];

        foreach ($tags as $tagName) {
            Tag::factory()->create(['name' => $tagName, 'slug' => generateSlug($tagName) ]);
        }

        // User
        User::factory()->create([
            'name' => 'Admin',
            'email' => "admin@gmail.com",
            'password'=> 12345,
        ]);
    }
}
