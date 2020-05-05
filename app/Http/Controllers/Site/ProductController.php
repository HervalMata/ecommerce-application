<?php

namespace App\Http\Controllers\Site;

use App\Contracts\AttributeContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\Exceptions\InvalidItemException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var ProductContract
     */
    protected $productRepository;
    /**
     * @var AttributeContract
     */
    protected $attributeRepository;

    /**
     * ProductController constructor.
     * @param ProductContract $productRepository
     * @param AttributeContract $attributeRepository
     */
    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.product', compact('product', 'attributes'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws InvalidItemException
     */
    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);
        return redirect()->back()->with('message', 'Item adicionado ao carrinho com sucesso!');
    }
}
