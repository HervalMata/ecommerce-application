<div class="title">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Configurações Gerais</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">Nome do Site</label>
                <input class="form-control" type="text" placeholder="Entre o nome do site" id="site_name" name="site_name" value="{{ config('settings.site_name') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Titulo do Site</label>
                <input class="form-control" type="text" placeholder="Entre o titulo do site" id="site_title" name="site_title" value="{{ config('settings.site_title') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">Endereço de email padrão</label>
                <input class="form-control" type="text" placeholder="Entre o nome do email" id="default_email_address" name="default_email_address" value="{{ config('settings.default_email_address') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_code">Código da moeda padrão</label>
                <input class="form-control" type="text" placeholder="Entre o código da moeda" id="currency_code" name="currency_code" value="{{ config('settings.currency_code') }}"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="currecy_symbol">Simbolo da moeda</label>
                <input class="form-control" type="text" placeholder="Entre o simbolo da moeda" id="currecy_symbol" name="currecy_symbol" value="{{ config('settings.currecy_symbol') }}"/>
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
