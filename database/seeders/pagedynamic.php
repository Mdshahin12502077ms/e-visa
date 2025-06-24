<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DynamicPage;
class pagedynamic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DynamicPage::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'description' => 'This is the about us page',
        ]);

        DynamicPage::create
        ([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'description' => 'This is the contact us page',
        ]);

        DynamicPage::create
        ([
            'title' => 'Terms and Conditions',
            'slug' => 'terms-and-conditions',
            'description' => 'This is the terms and conditions page',
        ]);
    }
}
