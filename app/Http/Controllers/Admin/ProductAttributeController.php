<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function loadAttributes()
    {
        $attributes = Attribute::all();
        return response()->json($attributes);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function productAttributes(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return response()->json($product->attributes);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function loadValues(Request $request)
    {
        $attribute = Attribute::findOrFail($request->id);
        return response()->json($attribute->values);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addAttribute(Request $request)
    {
        $productAttribute = ProductAttribute::create($request->data);
        if ($productAttribute) {
            return response()->json(['message' => 'Atributo do produto adicionado com sucesso.']);
        } else {
            return response()->json(['message' => 'Ocorreu um erro interno ao tentar adicionar o atributo do produto.']);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAttribute(Request $request)
    {
        $productAttribute = ProductAttribute::findOrFail($request->id);
        $productAttribute->delete();
        return response()->json(['status' => 'success', 'message' => 'Atributo do produto removido com sucesso.']);
    }
}
