<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cog"></i>
    <p>
      Configuración
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'catalogos.index'} ">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Catálogos</p>
      </router-link>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-warehouse"></i>
    <p>
      Inventario
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'presupuestos.index'} ">
        <i class="nav-icon fas fa-money-bill-alt"></i>
        <p>Presupuestos</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'proveedores.index'} ">
        <i class="nav-icon fas fa-users"></i>
        <p>Proveedores</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'productos.index'} ">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Productos</p>
      </router-link>
    </li>
  </ul>
</li>
<li class="nav-item">
  <router-link class="nav-link" :to="{ name: 'compras.index'} ">
    <i class="nav-icon fas fa-shopping-cart"></i>
    <p>Compras</p>
  </router-link>
</li>
<li class="nav-item">
  <router-link class="nav-link" :to="{ name: 'cxc.index'} ">
    <i class="nav-icon fas fa-money-bill"></i>
    <p>Cuentas por pagar</p>
  </router-link>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-university"></i>
    <p>
      Módulo bancos
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'cuentas.index'} ">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>Cuentas bancarias</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'cheques.index'} ">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Cheques</p>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'pagos.index'} ">
        <i class="nav-icon fas fa-tags"></i>
        <p>Pagos</p>
      </router-link>
    </li>
  </ul>
</li>