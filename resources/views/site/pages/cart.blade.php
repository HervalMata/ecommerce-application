@extends('site.app')
@section('title', 'Carrinho de Compras')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Carrinho de Compras</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if(\Cart::isEmpty())
                        <p class="alert alert-warning">Seu carrinho está vazio.</p>
                    @else
                        <div class="card">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col" width="120">Quantidade</th>
                                        <th scope="col" width="120">Preço</th>
                                        <th scope="col" class="text-right" width="200">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\Cart::getContent() as $item)
                                        <tr>
                                            <td>
                                                <figure class="media">
                                                    <figcaption class="media-body">
                                                        <h6 class="title text-truncate">{{ \Illuminate\Support\Str::words($item->name, 20) }}</h6>
                                                        @foreach($item->attributes as $key => $value)
                                                            <dl class="dlist-inline small">
                                                                <dy>{{ ucwords($key) }}</dy>
                                                                <dd>{{ ucwords($value) }}</dd>
                                                            </dl>
                                                        @endforeach
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <var class="price">{{ $item->quantity }}</var>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var class="price">{{ config('settings.currency_symbol').$item->price }}</var>
                                                    <small class="text-muted">Cada</small>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger"><i class="fa fa-times"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block mb-4">Limpar Carrinho</a>
                    <p class="alert alert-success">Adicionar R$ 5,00 para itens na sua ordem para qualificar sua entrega grátis</p>
                    <dl class="dlist-align h4">
                        <dt>Total:</dt>
                        <dd class="text-right"><strong>{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }}</strong></dd>
                    </dl>
                    <hr>
                    <figure class="itemside mb-3">
                        <aside class="aside"><img src="{{ asset('frontend/images/icons/pay-visa.png') }}"></aside>
                        <div class="text-wrap small text-muted">
                            Pague R$ 84,78 (R$ 14,79 Livre) Por usar ADCB Cartões
                        </div>
                    </figure>
                    <figure class="itemside mb-3">
                        <aside class="aside"><img src="{{ asset('frontend/images/icons/pay-mastercard.png') }}"></aside>
                        <div class="text-wrap small text-muted">
                            Pague com MasterCard e tenha 40% de desconto.
                            <br> LOrem ipsum dolor
                        </div>
                    </figure>
                    <a href="#" class="btn btn-success btn-lg btn-block">Continuar para Pagamento</a>
                </aside>
            </div>
        </div>
    </section>
@stop
