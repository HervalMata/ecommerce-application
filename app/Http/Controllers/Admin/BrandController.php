<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BrandController extends BaseController
{
    /**
     * @var BrandContract
     */
    private $brandRepository;

    /**
     * BrandController constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $brands = $this->brandRepository->listBrands();
        $this->setPageTitle('Marcas', 'Lista de todas as marcas');
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->setPageTitle('Marcas', 'Criar uma marca');
        return view('admin.brands.create');
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
            'image' => 'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $brand = $this->brandRepository->createBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava criando marca.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Marca adicionada com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->findBrandById($id);
        $brands = $this->brandRepository->listBrands();

        $this->setPageTitle('Marcas', 'Editar uma marca');
        return view('admin.brands.edit', compact('brands', 'brand'));
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
            'image' => 'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $brand = $this->brandRepository->updateBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava atualizando marca.', 'error', true, true);
        }
        return $this->responseRedirectBack( 'Marca atualizada com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $brand = $this->brandRepository->deleteBrand($id);

        if (!$brand) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava removendo marca.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Marca removida com sucesso', 'success', false, false);
    }
}
