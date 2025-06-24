<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class adminsetting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('admin_settings')->insert([
            'site_name' => 'My Awesome Website',
            'site_logo' => 'uploads/logo.png',
            'favicon' => 'uploads/favicon.ico',
            'contact_email' => 'info@example.com',
            'contact_phone' => '+880123456789',
            'address' => '123 Main Street, Dhaka, Bangladesh',

            // Social Media
            'facebook_url' => 'https://facebook.com/mywebsite',
            'twitter_url' => 'https://twitter.com/mywebsite',
            'instagram_url' => 'https://instagram.com/mywebsite',
            'youtube_url' => 'https://youtube.com/mywebsite',

            // SEO
            'meta_title' => 'Best Website in Bangladesh',
            'meta_description' => 'This is the best website for everything in Bangladesh.',
            'meta_keywords' => 'website, bangladesh, ecommerce, blog',

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
