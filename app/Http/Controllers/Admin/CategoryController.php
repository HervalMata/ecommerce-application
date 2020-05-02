<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    /**
     * @var CategoryContract
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories();
        $this->setPageTitle('Categorias', 'Lita de todas as categorias');
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories('id', 'asc');
        $this->setPageTitle('Categorias', 'Criar uma categoria');
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'parent_id' => 'required|not_in:0',
            'image' => 'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava criando categoria.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Categoria adicionada com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Categorias', 'Editar uma categoria');
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'parent_id' => 'required|not_in:0',
            'image' => 'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava atualizando categoria.', 'error', true, true);
        }
        return $this->responseRedirectBack( 'Categoria atualizada com sucesso', 'success', false, false);
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava removendo categoria.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Categoria removida com sucesso', 'success', false, false);
    }
}
