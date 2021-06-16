<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="/css/adminlte.css?v=2">
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper" id="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link" title="Ir a la página de bienvenida">
            {{config('app.name')}}
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" title="Cuenta de usuario">
            <i class="fas fa-user fa-lg"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">
              {{ $user->name }}
              <br>
              {{ $user->description }}
              <br>
              {{ $user->email }}
            </span>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="link-streched dropdown-item dropdown-footer link" type="submit">
                {{ __('Logout') }}
              </button>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="/" class="brand-link">
        <img src="https://ui-avatars.com/api/?length=1&size=48&name={{ config('app.name', 'Laravel') }}" alt="SV" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ $user->profile_photo_url }}" class="img-circle elevation-2" alt="Imagen de usuario">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              {{ $user->name }}
            </a>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'home'} ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>{{ __('Dashboard') }}</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'catalogos.index'} ">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Catálogos</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'materiales.index'} ">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Materiales</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'proveedores.index'} ">
                <i class="nav-icon fas fa-users"></i>
                <p>Proveedores</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'compras.index'} ">
                <i class="nav-icon fas fa-store-alt"></i>
                <p>Compras</p>
              </router-link>
            </li>
            {{--
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Otro módulo
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="fas fa-search nav-icon"></i>
                    <p>Búsqueda</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="fas fa-user-check nav-icon"></i>
                    <p>Habilitar contratista</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="fas fa-user-plus nav-icon"></i>
                    <p>Nuevo contratista</p>
                  </a>
                </li>
              </ul>
            </li>
            --}}
          </ul>
        </nav>
      </div>
    </aside>
    <router-view></router-view>
  </div>
  <script src="/js/adminlte.js?v=2"></script>
</body>
</html>