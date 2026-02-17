<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => '10 Tips for First-Time Home Buyers',
                'category' => 'Buying',
                'excerpt' => 'Navigate your first home purchase with confidence. From pre-approval to closing, we cover the essentials.',
                'content' => '<p>Buying your first home is an exciting milestone. Here are ten practical tips to help you through the process:</p><p>1. Check your credit score and fix any issues. 2. Get pre-approved for a mortgage. 3. Define your budget and stick to it. 4. Choose the right neighborhood. 5. Work with an experienced agent. 6. Don’t skip the home inspection. 7. Factor in closing costs. 8. Think long-term (resale value, schools). 9. Be prepared to negotiate. 10. Stay patient – the right home is out there.</p>',
                'author' => 'FindState Team',
                'status' => 'published',
            ],
            [
                'title' => 'How to Stage Your Home for a Quick Sale',
                'category' => 'Selling',
                'excerpt' => 'Simple staging techniques that can help your property sell faster and for a better price.',
                'content' => '<p>Staging can make a significant difference in how quickly your home sells. Focus on curb appeal, decluttering, neutral colors, and highlighting key spaces like the kitchen and master bedroom. Small investments in lighting and minor repairs often pay off.</p>',
                'author' => 'Sarah Mitchell',
                'status' => 'published',
            ],
            [
                'title' => 'Rental Market Trends in 2025',
                'category' => 'Market Trends',
                'excerpt' => 'An overview of what renters and landlords can expect in the coming year.',
                'content' => '<p>The rental market continues to evolve with remote work, sustainability, and tech integration. Demand remains strong in suburban areas, while urban cores see a rebound. Landlords who offer flexibility and modern amenities tend to attract quality tenants.</p>',
                'author' => 'James Chen',
                'status' => 'published',
            ],
            [
                'title' => 'Understanding Mortgage Rates and Your Options',
                'category' => 'Finance',
                'excerpt' => 'A straightforward guide to fixed vs. variable rates and how to choose the right loan.',
                'content' => '<p>Mortgage rates influence your monthly payment and total cost. Fixed-rate mortgages offer stability; variable rates can be lower initially but carry risk. Compare offers from multiple lenders and consider the length of time you plan to stay in the home.</p>',
                'author' => 'FindState Team',
                'status' => 'published',
            ],
            [
                'title' => 'Best Neighborhoods for Families: Schools and Safety',
                'category' => 'Neighborhoods',
                'excerpt' => 'What to look for when choosing a family-friendly neighborhood.',
                'content' => '<p>Families often prioritize school ratings, parks, and low crime. Use official school and crime data, visit at different times of day, and talk to residents. Proximity to work and childcare matters too.</p>',
                'author' => 'Emily Rodriguez',
                'status' => 'published',
            ],
        ];

        foreach ($posts as $data) {
            $slug = \Illuminate\Support\Str::slug($data['title']);
            Blog::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, ['slug' => $slug])
            );
        }
    }
}
