@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('stypes')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="title p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">Geral</a></li>
                    <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Imagens</a></li>
                    <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Atributos</a></li>
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
                                           name="name" id="name" value="{{ old('name', $product->name) }}">
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
                                                   name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
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
                                                @foreach($brands as $brand)
                                                    @if($product->brand_id == $brand->id)
                                                        <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                                    @else
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endif
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
                                                    @php $check = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' @endphp
                                                    <option value="{{ $category->id }}" {{ $check }}>{{ $category->name }}</option>
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
                                                   value="{{ old('price', $product->price) }}">
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
                                                   value="{{ old('special_price', $product->special_price) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="quantity">Quantidade></label>
                                            <input class="form-control @error('quantity') is-invalid @enderror"
                                                   placeholder="Entre com o preço" type="text" name="quantity"
                                                   id="quantity" value="{{ old('quantity', $product->quantity) }}">
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
                                                   value="{{ old('weight', $product->weight) }}">
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('weight')
                                                <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="description">Descrição</label>
                                        <textarea class="form-control" rows="4" name="description"
                                                  id="description">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="featured"
                                                       id="featured" {{ $product->featured == 1 ? 'checked' : '' }}/>Produto Principal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="status"
                                                       id="status" {{ $product->status == 1 ? 'checked' : '' }}/>Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fa fa-fw fa-lg fa-check-circle">Atualizar
                                                    Produto</i></button>
                                            $nbsp;$nbsp;$nbsp;
                                            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}"><i
                                                    class="fa fa-fw fa-lg fa-arrow-left"></i>Retornar </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="images">
                    <div class="tile">
                        <h3 class="tile-title">Carregar Imagens</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,3)">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="button" id="uploadButton">
                                        <i class="fa fa-fw fa-lg fa-upload"></i>Carregar Imagens
                                    </button>
                                </div>
                            </div>
                            @if($product->imagens)
                                <hr>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{ asset('storage/' . $image->full) }}" id="brand->logo" class="img-fluid" alt="imagem">
                                                    <a class="card-link float-right text-danger" href="{{ route('admin.products.images.delete', $image->id) }}">
                                                        <i class="fa fa-fw fa-lg fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="attributes">
                    <product-attributes :productId="{{ $product->id }}"></product-attributes>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
            $('categories').select2();

            let myDropzone = new Dropzone('#dropzone', {
                paramName: "image",
                addRemoveLinks: false,
                maxFilesize: 4,
                parallelUploads: 2,
                uploadMultiple: false,
                url: "{{ route('admin.products.images.upload') }}",
                autoProcessQueue: false,
            }):
            myDropzone.on("queuecomplete", function (file) {
                window.location.reload();
                showNotification('Completado', 'Todos as imagens do produto foram carregadas', 'success', 'fa-check');
            });
            $('#uploadButton').click(function () {
                if (myDropzone.files.length === 0) {
                    showNotification('Erro', 'Por favor selecione imagens para carregar.', 'danger', 'fa-close');
                } else {
                    myDropzone.proccessQueue();
                }
            });
            function showNotification(title, message, type, icon) {
                $.notify({
                    title + ':',
                    message: message,
                    icon: 'fa' + icon
                },{
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: "top",
                        align: 'right'
                    },
                });
            }
        });
    </script>
@endpush
