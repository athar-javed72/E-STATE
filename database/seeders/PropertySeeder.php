<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Agent;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $agents = Agent::all();
        if ($agents->isEmpty()) {
            return;
        }

        $properties = [
            [
                'title' => 'Modern Downtown Apartment with City Views',
                'type' => 'apartment',
                'listing_type' => 'for_sale',
                'price' => 425000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1850,
                'parking' => 2,
                'address' => '124 Main Street',
                'city' => 'New York',
                'state' => 'NY',
                'description' => 'Stunning modern apartment in the heart of the city. Floor-to-ceiling windows, open plan living, and premium finishes throughout. Building amenities include gym, rooftop terrace, and 24/7 concierge.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Spacious Family House with Garden',
                'type' => 'house',
                'listing_type' => 'for_sale',
                'price' => 689000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2800,
                'parking' => 2,
                'address' => '456 Oak Avenue',
                'city' => 'Austin',
                'state' => 'TX',
                'description' => 'Beautiful family home on a quiet street. Large backyard, updated kitchen, and finished basement. Perfect for growing families. Great school district.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Luxury Villa with Pool',
                'type' => 'villa',
                'listing_type' => 'for_sale',
                'price' => 1250000,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'area' => 4500,
                'parking' => 3,
                'address' => '789 Sunset Boulevard',
                'city' => 'Miami',
                'state' => 'FL',
                'description' => 'Exceptional villa with private pool, landscaped gardens, and panoramic views. High-end finishes, home theater, and smart home technology.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Cozy Condo for Rent – Near Metro',
                'type' => 'condo',
                'listing_type' => 'for_rent',
                'price' => 2200,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1100,
                'parking' => 1,
                'address' => '321 Park Lane',
                'city' => 'Chicago',
                'state' => 'IL',
                'description' => 'Bright and cozy condo minutes from metro and shops. In-unit laundry, modern kitchen. Pet-friendly building. Available immediately.',
                'featured' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Waterfront House – Lake Access',
                'type' => 'house',
                'listing_type' => 'for_sale',
                'price' => 895000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 3200,
                'parking' => 2,
                'address' => '100 Lake Road',
                'city' => 'Denver',
                'state' => 'CO',
                'description' => 'Stunning waterfront property with private dock. Open floor plan, stone fireplace, and large deck. Ideal for nature lovers and entertaining.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Downtown Loft – Industrial Chic',
                'type' => 'apartment',
                'listing_type' => 'for_rent',
                'price' => 2850,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 1400,
                'parking' => 1,
                'address' => '55 Warehouse District',
                'city' => 'Seattle',
                'state' => 'WA',
                'description' => 'Converted loft with exposed brick, high ceilings, and large windows. Walking distance to restaurants, galleries, and public transport.',
                'featured' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Gated Community Villa',
                'type' => 'villa',
                'listing_type' => 'for_sale',
                'price' => 750000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 3100,
                'parking' => 2,
                'address' => '200 Palm Drive',
                'city' => 'Phoenix',
                'state' => 'AZ',
                'description' => 'Elegant villa in secure gated community. Private garden, upgraded kitchen, and spacious master suite. Community pool and clubhouse.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Studio Apartment – Perfect for Professionals',
                'type' => 'apartment',
                'listing_type' => 'for_rent',
                'price' => 1650,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 650,
                'parking' => 0,
                'address' => '88 Business Park',
                'city' => 'Boston',
                'state' => 'MA',
                'description' => 'Efficient studio with smart layout. Building has co-working space and bike storage. Short walk to downtown and transit.',
                'featured' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Corner Residential Plot – Ready to Build',
                'type' => 'plot',
                'listing_type' => 'for_sale',
                'price' => 195000,
                'bedrooms' => null,
                'bathrooms' => null,
                'area' => 4500,
                'parking' => 0,
                'address' => '12 Maple Ridge Lane',
                'city' => 'Denver',
                'state' => 'CO',
                'description' => 'Cleared corner plot in a growing neighborhood. Utilities nearby, flat topography, ideal for a custom home or duplex project.',
                'featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Street-Front Commercial Unit',
                'type' => 'commercial',
                'listing_type' => 'for_rent',
                'price' => 5200,
                'bedrooms' => null,
                'bathrooms' => 2,
                'area' => 2200,
                'parking' => 6,
                'address' => '901 Market Boulevard',
                'city' => 'Chicago',
                'state' => 'IL',
                'description' => 'High-visibility commercial space with large display windows, open floor plan, restrooms, and dedicated parking for staff and customers.',
                'featured' => true,
                'status' => 'active',
            ],
        ];

        foreach ($properties as $index => $data) {
            Property::updateOrCreate(
                ['title' => $data['title'], 'city' => $data['city']],
                array_merge($data, [
                    'agent_id' => $agents->random()->id,
                    'slug' => \Illuminate\Support\Str::slug($data['title']) . '-' . ($index + 1),
                ])
            );
        }
    }
}
