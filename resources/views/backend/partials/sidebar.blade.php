<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN<sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      @can('listar usuarios')
      <li class="nav-item {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('usuarios.index') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuarios</span></a>
      </li>
      @endcan

      @can('modulo roles-permisos')
      <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Roles</span></a>
      </li>
      @endcan

      @can('listar clientes')
      <li class="nav-item {{ Request::is('admin/clientes*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('clientes.index') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Clientes</span></a>
      </li>
      @endcan

      @can('listar trabajos-sin-asignar')
      <li class="nav-item {{ Request::is('admin/trabajos') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.index') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Trabajos sin Asignar</span></a>
      </li>
      @endcan

      @can('listar trabajos-asignados')
      <li class="nav-item {{ Request::is('admin/trabajos/asignados') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.asignados') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Trabajos Asignados</span></a>
      </li>
      @endcan

      @can('listar mis-trabajos-asignados')
      <li class="nav-item {{ Request::is('admin/trabajos/mis_asignados') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.mis_asignados') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Mis Trabajos Asignados</span></a>
      </li>
      @endcan

      @can('listar trabajos-control-calidad')
      <li class="nav-item {{ Request::is('admin/trabajos/control') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.control') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Control de Calidad</span></a>
      </li>
      @endcan

      @can('listar trabajos-para-salida')
      <li class="nav-item {{ Request::is('admin/trabajos/salida') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.salida') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Trabajos para dar salida</span></a>
      </li>
      @endcan

      @can('listar trabajos-enviados')
      <li class="nav-item {{ Request::is('admin/trabajos/enviados') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trabajos.enviados') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Trabajos enviados</span></a>
      </li>
      @endcan

      @can('listar salidas-sin-cobrar')
      <li class="nav-item {{ Request::is('admin/salidas/sin_cobrar') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('salidas.sin_cobrar') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Salidas sin cobrar</span></a>
      </li>
      @endcan

      @can('listar salidas-cobradas')
      <li class="nav-item {{ Request::is('admin/salidas/cobradas') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('salidas.cobradas') }}">
          <i class="fas fa-fw fa-book"></i>
          <span>Salidas cobradas</span></a>
      </li>
      @endcan

      @can('modulo configuracion')
      <li class="nav-item {{ Request::is('admin/grupos*') ? 'active' : '' || Request::is('admin/instituciones*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Configuración</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ Request::is('admin/grupos*') ? 'active' : '' }}" href="{{ route('grupos.index') }}"><i class="fas fa-users"></i> Grupos</a>
            <a class="collapse-item {{ Request::is('admin/instituciones*') ? 'active' : '' }}" href="{{ route('instituciones.index') }}"><i class="fas fa-university"></i> Instituciones</a>
            <a class="collapse-item {{ Request::is('admin/tipos*') ? 'active' : '' }}" href="{{ route('tipos.index') }}"><i class="fas fa-user-graduate"></i> Tipos de Cliente</a>
            <a class="collapse-item {{ Request::is('admin/categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}"><i class="fas fa-clipboard-list"></i> Tipos de Trabajo</a>
            <a class="collapse-item {{ Request::is('admin/subs*') ? 'active' : '' }}" href="{{ route('subs.index') }}"><i class="fas fa-clipboard-list"></i> Subtipos de Trabajo</a>
            <a class="collapse-item {{ Request::is('admin/envios*') ? 'active' : '' }}" href="{{ route('envios.index') }}"><i class="fas fa-paper-plane"></i> Tipos de Envio</a>
            <a class="collapse-item {{ Request::is('admin/pagos*') ? 'active' : '' }}" href="{{ route('pagos.index') }}"><i class="fas fa-paper-plane"></i> Tipos de Pago</a>
            <a class="collapse-item {{ Request::is('admin/cuentas*') ? 'active' : '' }}" href="{{ route('cuentas.index') }}"><i class="fas fa-paper-plane"></i> Cuentas</a>
          </div>
        </div>
      </li>
      @endcan

      @can('listar ciclos')
      <li class="nav-item {{ Request::is('admin/ciclos*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ciclos.index') }}">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Ciclos Académicos</span></a>
      </li>
      @endcan

      <li class="nav-item">
        <a class="nav-link" href="{{ route('preview.index') }}">
          <i class="fas fa-fw fa-exchange-alt"></i>
          <span>Cambiar Ciclo</span></a>
      </li>
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>