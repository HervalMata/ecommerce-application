@extends('site.app')
@section('title', 'Compra Efetuada')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Compra Efetuada</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                <main class="col-sm-12">
                    <p class="alert alert-success">Sua compra foi efetuada com sucesso. Seu número da compra é : {{ $order->order_number }}.></p>
                </main>
            </div>
        </div>
    </section>
@stop
