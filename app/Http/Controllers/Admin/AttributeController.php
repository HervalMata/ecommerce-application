<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttributeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AttributeController extends BaseController
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $attributes = $this->attributeRepository->listAttributes();
        $this->setPageTitle('Atributos', 'Lista de todos os atributos');
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->setPageTitle('Atributos', 'Criar um atributo');
        return view('admin.attributes.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'frontend_type' => 'required'
        ]);

        $params = $request->except('_token');
        $attribute = $this->attributeRepository->createAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava criando atributo.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Atributo adicionado com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $attribute = $this->attributeRepository->findAttributeById($id);

        $this->setPageTitle('Atributos', 'Editar um atributo');
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'frontend_type' => 'required'
        ]);

        $params = $request->except('_token');
        $attribute = $this->attributeRepository->updateAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava atualizando atributo.', 'error', true, true);
        }
        return $this->responseRedirectBack( 'Atributo atualizado com sucesso', 'success', false, false);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $attribute = $this->attributeRepository->deleteAttribute($id);

        if (!$attribute) {
            return $this->responseRedirectBack('Erro ocorrido enquanto estava removendo atributo.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Atributo removido com sucesso', 'success', false, false);
    }
}
