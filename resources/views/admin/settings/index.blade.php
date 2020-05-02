@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="title p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">Geral</a></li>
                    <li class="nav-item"><a class="nav-link" href="#site-logo" data-toggle="tab">Logomarca</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer-seo" data-toggle="tab">Footer &amp; SEO</a></li>
                    <li class="nav-item"><a class="nav-link" href="#socials-links" data-toggle="tab">Link Rede Social</a></li>
                    <li class="nav-item"><a class="nav-link" href="#analytics" data-toggle="tab">Analises</a></li>
                    <li class="nav-item"><a class="nav-link" href="#payments" data-toggle="tab">Pagamento</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    @include('admin.settings.includes.general')
                </div>
                <div class="tab-pane fade" id="site-logo">
                    @include('admin.settings.includes.logo')
                </div>
                <div class="tab-pane fade" id="footer-seo">
                    @include('admin.settings.includes.footer_seo')
                </div>
                <div class="tab-pane fade" id="social_links">
                    @include('admin.settings.includes.social_links')
                </div>
                <div class="tab-pane fade" id="analytics">
                    @include('admin.settings.includes.analytics')
                </div>
                <div class="tab-pane fade" id="payments">
                    @include('admin.settings.includes.payments')
                </div>
            </div>
        </div>
    </div>
@endsection
