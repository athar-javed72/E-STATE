<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Property;
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

    public function test_admin_mark_as_read_form_posts_status_read_only(): void
    {
        $this->withoutVite();

        $admin = User::factory()->admin()->create();
        $contact = Contact::query()->create([
            'name' => 'Mark Form',
            'email' => 'mark@example.com',
            'subject' => 'Unread',
            'message' => 'Please mark me.',
            'type' => 'general',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->from(route('admin.contacts.index'))->patch(
            route('admin.contacts.update-status', $contact),
            ['status' => 'read']
        );

        $response->assertRedirect(route('admin.contacts.index'));
        $response->assertSessionHas('success');
        $this->assertSame('read', $contact->fresh()->status);
    }

    public function test_admin_can_view_contact_show_page(): void
    {
        $this->withoutVite();

        $admin = User::factory()->admin()->create();
        $property = Property::query()->create([
            'title' => 'Sunny Condo',
            'slug' => 'sunny-condo-test',
            'description' => 'Bright unit',
            'address' => '1 Main St',
            'city' => 'Austin',
            'state' => 'TX',
            'type' => 'condo',
            'listing_type' => 'for_sale',
            'price' => 350000,
            'status' => 'active',
        ]);

        $contact = Contact::query()->create([
            'property_id' => $property->id,
            'name' => 'Show Page Buyer',
            'email' => 'show@example.com',
            'phone' => '555-0100',
            'subject' => 'Full message subject',
            'message' => 'This is the complete inquiry body that should appear on the show page.',
            'type' => 'property_inquiry',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.contacts.show', $contact));

        $response->assertOk();
        $response->assertSee('Show Page Buyer');
        $response->assertSee('show@example.com');
        $response->assertSee('555-0100');
        $response->assertSee('Full message subject');
        $response->assertSee('This is the complete inquiry body that should appear on the show page.');
        $response->assertSee('Sunny Condo');
        $response->assertSee(route('properties.show', $property->slug), false);
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

    public function test_guest_cannot_view_contact_show_page(): void
    {
        $contact = Contact::query()->create([
            'name' => 'Hidden',
            'email' => 'hidden@example.com',
            'subject' => 'Secret',
            'message' => 'Nope',
            'type' => 'general',
            'status' => 'new',
        ]);

        $this->get(route('admin.contacts.show', $contact))
            ->assertRedirect(route('login'));
    }
}
