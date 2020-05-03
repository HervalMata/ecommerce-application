@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="title p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">Geral</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.products.store') }}" method="POST" role="form"
                             enctype="multipart/form-data">
                            @csrf
                            <h3 class="tile-title">Informação do Produto</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Nome <span
                                            class="m-1-5 text-danger"> *</span> </label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           name="name" id="name" value="{{ old('name') }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name')
                                        <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="sku">SKU <span class="m-1-5 text-danger"> *</span>
                                            </label>
                                            <input class="form-control @error('sku') is-invalid @enderror" type="text"
                                                   name="sku" id="sku" value="{{ old('sku') }}">
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="brand_id">Marca <span
                                                    class="m-1-5 text-danger"> *</span> </label>
                                            <select id="brand_id"
                                                    class="form-control custom-select mt-15 @error('brand_id') is-invalid @enderror"
                                                    name="brand_id">
                                                <option value="0">Selecione uma marca</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="categories">Categoria <span
                                                    class="m-1-5 text-danger"> *</span> </label>
                                            <select id="categories" class="form-control" multiple name="categories[]">
                                                <option value="0">Selecione uma categoria</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="price">Preço></label>
                                            <input class="form-control @error('price') is-invalid @enderror"
                                                   placeholder="Entre com o preço" type="text" name="price" id="price"
                                                   value="{{ old('price') }}">
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('price')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="special_price">Preço Especial></label>
                                            <input class="form-control" placeholder="Entre com o preço de venda"
                                                   type="text"
                                                   name="special_price" id="special_price"
                                                   value="{{ old('special_price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="quantity">Quantidade></label>
                                            <input class="form-control @error('quantity') is-invalid @enderror"
                                                   placeholder="Entre com o preço" type="text" name="quantity"
                                                   id="quantity" value="{{ old('quantity') }}">
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('quantity')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="weight">Peso></label>
                                            <input class="form-control @error('weight') is-invalid @enderror"
                                                   placeholder="Entre com o preço" type="text" name="weight" id="weight"
                                                   value="{{ old('weight') }}">
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('weight')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="description">Descrição</label>
                                        <textarea class="form-control" rows="4" name="description"
                                                  id="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="featured"
                                                       id="featured"/>Produto Principal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="status"
                                                       id="status"/>Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fa fa-fw fa-lg fa-check-circle">Salvar
                                                    Produto</i></button>
                                            $nbsp;$nbsp;$nbsp;
                                            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}"><i
                                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('categories').select2();
        });
    </script>
@endpush
