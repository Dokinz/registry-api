<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Registry API",
 *     description="API Documentation",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/items",
 *     operationId="getItemsDifference",
 *     tags={"Item"},
 *     summary="Get the difference of items",
 *     description="Accepts an array of items in the 'diff' query parameter and returns which items are NOT in the registry.",
 *     @OA\Parameter(
 *         name="diff",
 *         in="query",
 *         required=true,
 *         description="An array of items to check the difference",
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(type="string")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=422, description="Validation error")
 * )
 *
 * @OA\Get(
 *     path="/api/items/{item}",
 *     operationId="checkItem",
 *     tags={"Item"},
 *     summary="Check if an item exists",
 *     description="Check if an item exists and is not inverted.",
 *     @OA\Parameter(
 *         name="item",
 *         in="path",
 *         required=true,
 *         description="Item name",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Item exists",
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Item exists"))
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Item not found",
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Item does not exist"))
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/items",
 *     operationId="createItem",
 *     tags={"Item"},
 *     summary="Create a new item",
 *     description="Creates a new item or reactivates it if it's currently inverted.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"item"},
 *             @OA\Property(property="item", type="string", example="NewItem")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Item has been successfully added",
 *     ),
 *     @OA\Response(response=422, description="Validation error")
 * )
 *
 * @OA\Delete(
 *     path="/api/items/{item}",
 *     operationId="removeItem",
 *     tags={"Item"},
 *     summary="Mark an item as inverted",
 *     description="Sets 'is_inverted' = true for the given item.",
 *     @OA\Parameter(
 *         name="item",
 *         in="path",
 *         required=true,
 *         description="Item name",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response=200, description="Item has been marked as inverted"),
 * )
 *
 * @OA\Post(
 *     path="/api/items/invert",
 *     operationId="invertAllItems",
 *     tags={"Item"},
 *     summary="Invert all items",
 *     description="Flips 'is_inverted' for every item.",
 *     @OA\Response(response=200, description="All items have been inverted")
 * )
 */
class ApiDocumentation
{

}
