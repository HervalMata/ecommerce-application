@extends('site.app')
@section('title', 'Cadastro')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Cadastro</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">Cadastro</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('register') }}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="first_name">Primeiro Nome</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name" id="first_name" value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">Ultimo Nome</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                       name="last_name" id="last_name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirme a Senha</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" id="password_confirmation">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="city">Cidade</label>
                                    <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">País</label>
                                    <select id="country" class="form-control" name="country">
                                        <option> Escolha...</option>
                                        <option value="Brazil">Brasil</option>
                                        <option value="United Kingdom">Inglaterra</option>
                                        <option value="France">França</option>
                                        <option value="United States">Eua</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"> Cadastrar </button>
                            </div>
                        </form>
                    </article>
                    <small class="text-muted text-center">Ao clicar em Cadastrar, Você confirma que aceita nossos <br> Termos de Uso e Politicas de Privacidade.</small>
                </div>
            </div>
        </div>
    </section>
@stop
