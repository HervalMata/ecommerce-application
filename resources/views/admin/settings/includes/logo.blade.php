<div class="title">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Logo do site</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-3">
                    @if(config('settings.site_logo') != null)
                        <img src="{{ asset('storage/'. config('settings.site_logo')) }}" id="logoImg" style="width: 80px; height: auto;">
                    @else
                        <img src="https://via.placeholder.com/80x80?text=Placeholder+image" id="logoImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Logo do Site</label>
                        <input class="form-control" type="file" name="site_logo" onchange="loadFile(event, 'logoImg')"/>
                    </div>
                </div>
            </div>
            <div class="row m-4">
                <div class="col-3">
                    @if(config('settings.site_favicon') != null)
                        <img src="{{ asset('storage/'. config('settings.site_favicon')) }}" id="faviconImg" style="width: 80px; height: auto;">
                    @else
                        <img src="https://via.placeholder.com/80x80?text=Placeholder+image" id="faviconImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Icone do Site</label>
                        <input class="form-control" type="file" name="site_favicon" onchange="loadFile(event, 'faviconImg')"/>
                    </div>
                </div>
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
@push('scripts')
    <script>
        loadFile = function (event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
