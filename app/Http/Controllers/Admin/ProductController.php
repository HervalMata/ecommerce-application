<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductController extends BaseController
{
    /**
     * @var BrandContract
     */
    private $brandRepository;
    /**
     * @var CategoryContract
     */
    private $categoryRepository;
    /**
     * @var ProductContract
     */
    private $productRepository;

    /**
     * ProductController constructor.
     * @param BrandContract $brandRepository
     * @param CategoryContract $categoryRepository
     * @param ProductContract $productRepository
     */
    public function __construct(
        BrandContract $brandRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = $this->productRepository->listProducts();
        $this->setPageTitle('Produtos', 'Lista de todos os produtos');
        return view('admin.products.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');
        $this->setPageTitle('Produtos', 'Criar um produto');
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $params = $request->except('_token');
        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava criando produto.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Categoria adicionada com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Produtos', 'Editar uma produto');
        return view('admin.products.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function update(StoreProductRequest $request)
    {
        $params = $request->except('_token');
        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava atualizando produto.', 'error', true, true);
        }
        return $this->responseRedirectBack( 'Produto atualizad0 com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $product = $this->productRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava removendo produto.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Produto removido com sucesso', 'success', false, false);
    }
}
