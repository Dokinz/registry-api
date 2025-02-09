<?php

namespace Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_new_item(): void
    {
        $response = $this->postJson('/api/items', ['item' => 'red']);

        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'red']);
    }

    public function test_store_reactivates_inverted_item(): void
    {
        Item::create(['name' => 'red', 'is_inverted' => true]);

        $response = $this->postJson('/api/items', ['item' => 'red']);

        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'red', 'is_inverted' => false]);
    }

    public function test_store_fails_when_item_is_missing(): void
    {
        $response = $this->postJson('/api/items', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['item']);
    }

    public function test_store_fails_when_item_contains_invalid_characters(): void
    {
        $response = $this->postJson('/api/items', ['item' => 'red@!']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['item']);
    }
}
