<?php

namespace Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemInvertTest extends TestCase
{
    use RefreshDatabase;

    public function test_invert_flips_all_items(): void
    {
        Item::create(['name' => 'red', 'is_inverted' => false]);
        Item::create(['name' => 'blue', 'is_inverted' => true]);

        $response = $this->postJson('/api/items/invert');
        $response->assertStatus(200);

        $this->assertDatabaseHas('items', ['name' => 'red', 'is_inverted' => true]);
        $this->assertDatabaseHas('items', ['name' => 'blue', 'is_inverted' => false]);
    }
    
    public function test_double_invert_returns_items_to_original_state(): void
    {
        Item::create(['name' => 'red', 'is_inverted' => false]);
        Item::create(['name' => 'blue', 'is_inverted' => true]);

        $this->postJson('/api/items/invert');
        $this->postJson('/api/items/invert');

        $this->assertDatabaseHas('items', ['name' => 'red', 'is_inverted' => false]);
        $this->assertDatabaseHas('items', ['name' => 'blue', 'is_inverted' => true]);
    }
}
