<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'David & Lisa Morrison',
                'designation' => 'First-Time Buyers',
                'location' => 'Austin, TX',
                'content' => 'FindState made our first home purchase stress-free. Our agent was patient, professional, and found us the perfect family home within our budget. We couldn’t be happier!',
                'rating' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Jennifer Walsh',
                'designation' => 'Property Investor',
                'location' => 'Miami, FL',
                'content' => 'I’ve worked with several agencies; FindState stands out for their market knowledge and responsiveness. They helped me secure two rental properties this year.',
                'rating' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Robert Kim',
                'designation' => 'Home Seller',
                'location' => 'Seattle, WA',
                'content' => 'Our house sold in under two weeks at above asking price. The team’s staging advice and marketing strategy really made a difference. Highly recommend.',
                'rating' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Amanda Foster',
                'designation' => 'Renter',
                'location' => 'Chicago, IL',
                'content' => 'I was relocating for work and needed a place fast. FindState had great options and helped me sign a lease within a week. Smooth process from start to finish.',
                'rating' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Thomas Reed',
                'designation' => 'Luxury Buyer',
                'location' => 'New York, NY',
                'content' => 'Professional, discreet, and incredibly knowledgeable about the high-end market. They understood exactly what we were looking for and delivered.',
                'rating' => 5,
                'status' => 'active',
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                ['name' => $data['name'], 'content' => $data['content']],
                $data
            );
        }
    }
}
