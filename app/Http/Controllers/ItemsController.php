<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemIndexRequest;
use App\Http\Requests\ItemStoreRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(ItemIndexRequest $request): JsonResponse
    {
        $diff = $request->validated()['diff'];
        $diffArr = $this->itemService->diff($diff);
        return response()->json(['data' => $diffArr]);
    }

    public function show($item): JsonResponse
    {
        $exists = $this->itemService->check($item);
        return response()->json([
            'message' => $exists ? 'Item exists' : 'Item does not exist',
        ], $exists ? 200 : 404);
    }

    public function store(ItemStoreRequest $request)
    {
        $item = $request->validated()['item'];
        $this->itemService->add($item);
        return response()->noContent(200);
    }

    public function destroy(string $item)
    {
        $this->itemService->remove($item);
        return response()->noContent(200);
    }

    public function invert()
    {
        $this->itemService->invert();
        return response()->noContent(200);
    }
}
