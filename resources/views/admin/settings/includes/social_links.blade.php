<div class="title">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Links Socais</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="social_facebook">Perfil do Facebook</label>
                <input class="form-control" type="text" placeholder="Entre o perfil do facebook" id="social_facebook" name="social_facebook" value="{{ config('settings.social_facebook') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="social_twitter">Perfil do Twitter</label>
                <input class="form-control" type="text" placeholder="Entre o perfil do twitter" id="social_twitter" name="social_twitter" value="{{ config('settings.social_twitter') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="social_instagram">Perfil do Instagram</label>
                <input class="form-control" type="text" placeholder="Entre o perfil do instagram" id="social_instagram" name="social_instagram" value="{{ config('settings.social_instagram') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="social_linkedin">Perfil do LinkedIn</label>
                <input class="form-control" type="text" placeholder="Entre o perfil do LinkedIn" id="social_linkedin" name="social_linkedin" value="{{ config('settings.social_linkedin') }}"/>
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
