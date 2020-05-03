<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Traits\UploadAble;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    use UploadAble;

    /**
     * @var ProductContract
     */
    private $productRepository;

    /**
     * ProductImageController constructor.
     * @param ProductContract $productRepository
     */
    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {
        $product = $this->productRepository->findProductById($request->product->id);
        if ($request->has('image')) {
            $image = $this->uploadOne($request->image, 'products');
            $productImage = new ProductImage([
                'full' => $image,
            ]);
            $product->images()->save($productImage);
        }
        return response()->json(['status' => 'Success']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $image = ProductImage::findOrFail($id);
        if ($image->full = '') {
            $this->deleteOne($image->full);
        }
        $image->delete();
        return redirect()->back();
    }

}
