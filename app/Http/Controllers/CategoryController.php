<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{
    function getAll(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Category::all(),
            'status' => 'success',
        ], ResponseAlias::HTTP_OK);
    }
}
