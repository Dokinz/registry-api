<?php

namespace Tests\Feature\Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_inverts_existing_item(): void
    {
        Item::create(['name' => 'red']);

        $response = $this->deleteJson('/api/items/red');
        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'red', 'is_inverted' => true]);
    }

    public function test_destroy_creates_inverted_item_if_item_does_not_exist(): void
    {
        $response = $this->deleteJson('/api/items/blue');

        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'blue', 'is_inverted' => true]);
    }

    public function test_destroy_does_not_change_already_inverted_item(): void
    {
        Item::create(['name' => 'red', 'is_inverted' => true]);

        $response = $this->deleteJson('/api/items/red');
        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'red', 'is_inverted' => true]);
    }
}
