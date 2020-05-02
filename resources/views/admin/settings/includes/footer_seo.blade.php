<div class="title">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Rodapé &amp; SEO</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="footer_copyright">Direitos de cópia</label>
                <textarea class="form-control" rows="4" placeholder="Entre o texto do rodapé" id="footer_copyright" name="footer_copyright" value="{{ config('settings.footer_copyright') }}"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_title">Titulo para SEO</label>
                <input class="form-control" type="text" placeholder="Entre o titulo do rodapé" id="seo_meta_title" name="seo_meta_title" value="{{ config('settings.seo_meta_title') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_description">Descrição para SEO</label>
                <textarea class="form-control" rows="4" placeholder="Entre a descrição do rodapé" id="seo_meta_description" name="seo_meta_description" value="{{ config('settings.seo_meta_description') }}"></textarea>
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
