<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemService
{
    public function check(string $item): bool
    {
        return Item::where('name', $item)
            ->where('is_inverted', false)
            ->exists();
    }

    public function add(string $item): void
    {
        $item = Item::firstOrCreate(['name' => $item]);

        if ($item->is_inverted) {
            $item->is_inverted = false;
            $item->save();
        }
    }

    public function remove(string $item): void
    {
        $item = Item::firstOrCreate(['name' => $item]);

        if (!$item->is_inverted) {
            $item->is_inverted = true;
            $item->save();
        }
    }

    public function diff(array $submittedItems): array
    {
        $inRegistryArr = Item::where('is_inverted', false)
            ->pluck('name')
            ->toArray();

        return array_values(array_diff($submittedItems, $inRegistryArr));
    }

    public function invert(): void
    {
        Item::query()->update([
            'is_inverted' => DB::raw('NOT is_inverted')
        ]);
    }
}
