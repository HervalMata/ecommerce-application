<div class="title">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Analises</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="google_analytics">Código do Google Analytics</label>
                <textarea class="form-control" rows="4" placeholder="Entre o código do google analytics" id="google_analytics" name="google_analytics" value="{{ config('settings.google_analytics') }}"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="facebbok_pixels">Código do Facebook Pixels</label>
                <textarea class="form-control" rows="4" placeholder="Entre a descrição do rodapé" id="facebbok_pixels" name="facebbok_pixels" value="{{ config('settings.seo_meta_description') }}"></textarea>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Atualizar Configurações</button>
                </div>
            </div>
        </div>
    </form>
</div>
