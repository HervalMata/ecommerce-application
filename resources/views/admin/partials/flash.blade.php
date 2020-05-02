@php
    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning');
@endphp
@if($errors) @foreach($errors as $key => $value)
       <div class="alert alert-danger alert-dismissible" role="alert">
           <button class="close" type="button" data-dismiss="alert">x</button>
           <strong>Erro!</strong> {{ $value }}
       </div>
@endforeach  @endif

@if($messages) @foreach($messages as $key => $value)
    <div class="alert alert-success alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">x</button>
        <strong>Sucesso!</strong> {{ $value }}
    </div>
@endforeach  @endif

@if($info) @foreach($info as $key => $value)
    <div class="alert alert-info alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">x</button>
        <strong>Informaçao!</strong> {{ $value }}
    </div>
@endforeach  @endif

@if($warnings) @foreach($warnings as $key => $value)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">x</button>
        <strong>Cuidado!</strong> {{ $value }}
    </div>
@endforeach  @endif
