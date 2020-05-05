@extends('site.app')
@section('title', 'Checkout')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(Session::has('error'))
                        <p class="alert alert-success">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">Detalhes do Pagamento</h4>
                            </header>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>Primeiro Nome</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="col form-group">
                                        <label>Ultimo Nome</label>
                                        <input type="text" class="form-control" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label>Cidade</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>País</label>
                                        <input type="text" class="form-control" name="country">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label>CEP</label>
                                        <input type="text" class="form-control" name="postal_code">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Celular</label>
                                        <input type="text" class="form-control" name="phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                    <small class="form-text text-muted">Nós nunca repassaremos seu email para nenhuma outra pessoa</small>
                                </div>
                                <div class="form-group">
                                    <label>Observações</label>
                                    <textarea type="text" class="form-control" name="notes" roes="6"></textarea>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">Sua Compra</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total:</dt>
                                            <dd class="text-right h5 b">{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }}</dd>
                                        </dl>
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Finalizr Ordem</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop
