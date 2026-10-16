<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContactStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_contact_status_to_read(): void
    {
        $this->withoutVite();

        $admin = User::factory()->admin()->create();
        $contact = Contact::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Question about listing',
            'message' => 'Please call me back.',
            'type' => 'general',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->patch(
            route('admin.contacts.update-status', $contact),
            ['status' => 'read']
        );

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'read',
        ]);
    }

    public function test_admin_contact_search_filters_by_name_email_subject(): void
    {
        $this->withoutVite();

        $admin = User::factory()->admin()->create();

        Contact::query()->create([
            'name' => 'Alpha Buyer',
            'email' => 'alpha@example.com',
            'subject' => 'Downtown loft',
            'message' => 'Interested',
            'type' => 'general',
            'status' => 'new',
        ]);

        Contact::query()->create([
            'name' => 'Beta Seller',
            'email' => 'beta@example.com',
            'subject' => 'Pricing help',
            'message' => 'Need advice',
            'type' => 'general',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.contacts.index', ['search' => 'alpha@example.com']));

        $response->assertOk();
        $response->assertSee('Alpha Buyer');
        $response->assertDontSee('Beta Seller');
    }

    public function test_guest_cannot_update_contact_status(): void
    {
        $contact = Contact::query()->create([
            'name' => 'Guest Blocked',
            'email' => 'guest@example.com',
            'subject' => 'Hello',
            'message' => 'Hi',
            'type' => 'general',
            'status' => 'new',
        ]);

        $this->patch(route('admin.contacts.update-status', $contact), ['status' => 'read'])
            ->assertRedirect(route('login'));
    }
}
