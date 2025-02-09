<?php

namespace Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_returns_200_if_item_exists(): void
    {
        Item::create(['name' => 'red']);

        $response = $this->getJson('/api/items/red');

        $response->assertStatus(200);
    }

    public function test_check_returns_404_if_item_does_not_exist(): void
    {
        $response = $this->getJson('/api/items/blue');

        $response->assertStatus(404);
    }

    public function test_check_returns_404_if_item_is_inverted(): void
    {
        Item::create(['name' => 'red', 'is_inverted' => true]);

        $response = $this->getJson('/api/items/red');

        $response->assertStatus(404);
    }

}
