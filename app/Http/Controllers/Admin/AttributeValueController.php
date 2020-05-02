<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttributeContract;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * @var AttributeContract
     */
    private $attributeRepository;

    /**
     * AttributeController constructor.
     * @param AttributeContract $attributeRepository
     */
    public function __construct(AttributeContract $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getValues(Request $request)
    {
        $attributeId = $request->input('id');
        $attribute = $this->attributeRepository->findAttributeById($attributeId);
        $values = $attribute->values;
        return response()->json($values);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addValues(Request $request)
    {
        $value = new AttributeValue();
        $value->attribute_id = $request->input('id');
        $value->value = $request->input('value');
        $value->price = $request->input('price');
        $value->save();

        return response()->json($value);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('valueId'));
        $attributeValue->attribute_id = $request->input('id');
        $attributeValue->value = $request->input('value');
        $attributeValue->price = $request->input('price');
        $attributeValue->save();
        return response()->json($attributeValue);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('id'));
        $attributeValue->delete();
        return response()->json(['status' => 'success', 'message' => 'Valor do atributo removido com sucesso.']);
    }
}
