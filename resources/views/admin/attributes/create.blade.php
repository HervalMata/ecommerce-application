@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
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
                        <form action="{{ route('admin.attributes.store') }}" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">Informações dos Atributos</h3>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="code">Código <span class="m-1-5 text-danger"> *</span> </label>
                                    <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" value="{{ old('code') }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Nome <span class="m-1-5 text-danger"> *</span> </label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="frontend_type">Tipo</label>
                                    @php $types = ['select' => 'Select Box', 'radio' => 'Radio Button', 'text' => 'Text Field', 'text_area' => 'Text Area']; @endphp
                                    <select id="frontend_type" class="form-control" name="frontend_type">
                                        @foreach($types as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="is_filterable" id="is_filterable"/>Filtro
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="is_erquired" id="is_erquired"/>Requerido
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle">Salvar Atributo</i> </button>
                                        $nbsp;$nbsp;$nbsp;
                                        <a class="btn btn-secondary" href="{{ route('admin.attributes.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
