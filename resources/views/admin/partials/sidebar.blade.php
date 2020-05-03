<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">Herval Mata</p>
            <p class="app-sidebar__user-name">Desenvolvedor Frontend</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item active" {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }} href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }} href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Configurações</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }} href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Categorias</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }} href="{{ route('admin.attributes.index') }}">
                <i class="app-menu__icon fa fa-th"></i>
                <span class="app-menu__label">Atributos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" {{ Route::currentRouteName() == 'admin.brands.index' ? 'active' : '' }} href="{{ route('admin.brands.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Marcas</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Usuários</span>
                <i class="treeview-indicator fa-users fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Usuários Admin</a>
                </li>
                <li>
                    <a class="treeview-item" href="#" target="_blank" rel="noopener noreferrer"><i class="icon fa fa-circle-o"></i> Funções</a>
                </li>
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Permissões</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Configurações</span>
            </a>
        </li>
    </ul>
</aside>
