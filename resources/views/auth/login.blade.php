@extends('site.app')
@section('title', 'Login')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Login</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">Entrar</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('login') }}" method="POST" role="form">
                            @csrf
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
                                       name="password" id="password" value="{{ old('password') ? 'checked' : '' }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row mr-auto">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember"
                                               id="remember" value="{{ old('remember') ? 'checked' : '' }}">
                                        <label class="form-check-label" for="remember">{{ __('Lembre Me') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"> Entrar </button>
                            </div>
                        </form>
                    </article>
                    <div class="border-top card-body text-center">Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a> </div>
                </div>
            </div>
        </div>
    </section>
@stop
