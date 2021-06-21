import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	mode: 'history',
	linkActiveClass: 'active',
	linkExactActiveClass: 'exact-active',
	routes: [
	{
		path: '/home',
		name: 'home',
		component: require('./components/HomeComponent').default,
		meta: { title: 'Home'}
	},
	{
		path: '/usuarios',
		name: 'usuarios.index',
		component: require('./components/usuarios/IndexComponent').default,
		meta: { title: 'Proveedores'}
	},
	{
		path: '/usuarios/create',
		name: 'usuarios.create',
		component: require('./components/usuarios/CreateComponent').default,
		meta: { title: 'Crear proveedor'}
	},
	{
		path: '/usuarios/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'usuarios.edit',
			component: require('./components/usuarios/EditComponent').default,
			meta: { title: 'Modificar proveedor'}
		},
		{
			path: 'show',
			name: 'usuarios.show',
			component: require('./components/usuarios/ShowComponent').default,
			meta: { title: 'Detalle de proveedor'}
		}
		]
	},
	{
		path: '/catalogos',
		name: 'catalogos.index',
		component: require('./components/catalogos/IndexComponent').default,
		meta: { title: 'Catálogos'}
	},
	{
		path: '/productos',
		name: 'productos.index',
		component: require('./components/productos/IndexComponent').default,
		meta: { title: 'Materiales'}
	},
	{
		path: '/productos/create',
		name: 'productos.create',
		component: require('./components/productos/CreateComponent').default,
		meta: { title: 'Crear material'}
	},
	{
		path: '/productos/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'productos.edit',
			component: require('./components/productos/EditComponent').default,
			meta: { title: 'Modificar material'}
		},
		{
			path: 'show',
			name: 'productos.show',
			component: require('./components/productos/ShowComponent').default,
			meta: { title: 'Detalle de material'}
		}
		]
	},
	{
		path: '/presupuestos',
		name: 'presupuestos.index',
		component: require('./components/presupuestos/IndexComponent').default,
		meta: { title: 'Presupuestos'}
	},
	{
		path: '/presupuestos/create',
		name: 'presupuestos.create',
		component: require('./components/presupuestos/CreateComponent').default,
		meta: { title: 'Crear presupuestos'}
	},
	{
		path: '/presupuestos/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'presupuestos.edit',
			component: require('./components/presupuestos/EditComponent').default,
			meta: { title: 'Modificar presupuestos'}
		},
		{
			path: 'show',
			name: 'presupuestos.show',
			component: require('./components/presupuestos/ShowComponent').default,
			meta: { title: 'Detalle de presupuestos'}
		}
		]
	},
	{
		path: '/proveedores',
		name: 'proveedores.index',
		component: require('./components/proveedores/IndexComponent').default,
		meta: { title: 'Proveedores'}
	},
	{
		path: '/proveedores/create',
		name: 'proveedores.create',
		component: require('./components/proveedores/CreateComponent').default,
		meta: { title: 'Crear proveedor'}
	},
	{
		path: '/proveedores/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'proveedores.edit',
			component: require('./components/proveedores/EditComponent').default,
			meta: { title: 'Modificar proveedor'}
		},
		{
			path: 'show',
			name: 'proveedores.show',
			component: require('./components/proveedores/ShowComponent').default,
			meta: { title: 'Detalle de proveedor'}
		}
		]
	},
	{
		path: '/compras',
		name: 'compras.index',
		component: require('./components/compras/IndexComponent').default,
		meta: { title: 'Proveedores'}
	},
	{
		path: '/compras/create',
		name: 'compras.create',
		component: require('./components/compras/CreateComponent').default,
		meta: { title: 'Registrar compra'}
	},
	{
		path: '/compras/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'compras.edit',
			component: require('./components/compras/EditComponent').default,
			meta: { title: 'Modificar compra'}
		},
		{
			path: 'show',
			name: 'compras.show',
			component: require('./components/compras/ShowComponent').default,
			meta: { title: 'Detalle de compra'}
		}
		]
	},
	{
		path: '/cxp',
		name: 'cxc.index',
		component: require('./components/cxc/IndexComponent').default,
		meta: { title: 'Cuentas por pagar'}
	},
	{
		path: '/cxp/:id/cheque',
		name: 'cxc.cheque',
		component: require('./components/cxc/GenerarChequeComponent').default,
		meta: { title: 'Generar cheque'}
	},
	{
		path: '/cuentas',
		name: 'cuentas.index',
		component: require('./components/cuentas/IndexComponent').default,
		meta: { title: 'Cuentas bancarias'}
	},
	{
		path: '/cuentas/create',
		name: 'cuentas.create',
		component: require('./components/cuentas/CreateComponent').default,
		meta: { title: 'Crear cuenta bancaria'}
	},
	{
		path: '/cuentas/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'cuentas.edit',
			component: require('./components/cuentas/EditComponent').default,
			meta: { title: 'Modificar cuenta bancaria'}
		},
		{
			path: 'show',
			name: 'cuentas.show',
			component: require('./components/cuentas/ShowComponent').default,
			meta: { title: 'Detalle de cuenta bancaria'}
		}
		]
	},
	{
		path: '/cheques',
		name: 'cheques.index',
		component: require('./components/cheques/IndexComponent').default,
		meta: { title: 'Cheques emitidos'}
	},
	{
		path: '/cheques/:id',
		name: 'cheques.show',
		component: require('./components/cheques/ChequeComponent').default,
		meta: { title: 'Cheques emitido'}
	},
	{
		path: '/pagos',
		name: 'pagos.index',
		component: require('./components/pagos/IndexComponent').default,
		meta: { title: 'Pagos realizados'}
	},
	{
		path: '*',
		component: require('./components/404').default,
		meta: { title: 'Página no encontrada' }
	}
	]
})