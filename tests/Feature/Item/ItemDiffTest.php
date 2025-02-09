<?php

namespace Tests\Feature\Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDiffTest extends TestCase
{
    use RefreshDatabase;

    public function test_diff_returns_correct_difference(): void
    {
        Item::insert([
            ['name' => 'red'],
            ['name' => 'green'],
        ]);

        $params = http_build_query(['diff' => ['red', 'blue', 'green', 'yellow']]);
        $response = $this->getJson('/api/items?' . $params);

        $response->assertStatus(200)
            ->assertJson([
                'data' => ['blue', 'yellow'],
            ]);
    }

    public function test_diff_fails_when_diff_is_missing(): void
    {
        $response = $this->getJson('/api/items');
        $response->assertStatus(422);
    }

    public function test_diff_fails_when_diff_is_empty(): void
    {
        $params = http_build_query(['diff' => []]);
        $response = $this->getJson('/api/items?' . $params);

        $response->assertStatus(422);
    }

    public function test_diff_fails_validation_for_invalid_input(): void
    {
        $params = http_build_query(['diff' => ['red', '@#$']]);
        $response = $this->getJson('/api/items?' . $params);

        $response->assertStatus(422);
    }
}
