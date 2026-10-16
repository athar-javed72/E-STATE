<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            [
                'name' => 'Sarah Mitchell',
                'email' => 'sarah.mitchell@findstate.com',
                'phone' => '+1 (555) 101-2020',
                'designation' => 'Senior Real Estate Advisor',
                'bio' => 'Over 12 years of experience in residential and commercial real estate. Specializing in luxury homes and first-time buyers.',
                'experience' => 12,
                'rating' => 4.9,
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'status' => 'active',
            ],
            [
                'name' => 'James Chen',
                'email' => 'james.chen@findstate.com',
                'phone' => '+1 (555) 102-3030',
                'designation' => 'Luxury Property Specialist',
                'bio' => 'Focused on high-end properties and investment opportunities. Trusted by over 200 satisfied clients.',
                'experience' => 8,
                'rating' => 4.8,
                'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
                'status' => 'active',
            ],
            [
                'name' => 'Emily Rodriguez',
                'email' => 'emily.rodriguez@findstate.com',
                'phone' => '+1 (555) 103-4040',
                'designation' => 'Real Estate Consultant',
                'bio' => 'Expert in family homes and suburban properties. Dedicated to finding the perfect fit for every client.',
                'experience' => 6,
                'rating' => 4.7,
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
                'status' => 'active',
            ],
            [
                'name' => 'Michael Thompson',
                'email' => 'michael.t@findstate.com',
                'phone' => '+1 (555) 104-5050',
                'designation' => 'Commercial & Residential Agent',
                'bio' => 'Dual expertise in commercial and residential real estate. Helping investors and families alike.',
                'experience' => 10,
                'rating' => 4.85,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'status' => 'active',
            ],
        ];

        foreach ($agents as $data) {
            Agent::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['slug' => \Illuminate\Support\Str::slug($data['name'])])
            );
        }
    }
}
