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
		component: require('./components/ExampleComponent').default,
		meta: { title: 'Home'}
	},
	{
		path: '/catalogos',
		name: 'catalogos.index',
		component: require('./components/catalogos/IndexComponent').default,
		meta: { title: 'Catálogos'}
	},
	{
		path: '/materiales',
		name: 'materiales.index',
		component: require('./components/materiales/IndexComponent').default,
		meta: { title: 'Materiales'}
	},
	{
		path: '/materiales/create',
		name: 'materiales.create',
		component: require('./components/materiales/CreateComponent').default,
		meta: { title: 'Crear material'}
	},
	{
		path: '/materiales/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'materiales.edit',
			component: require('./components/materiales/EditComponent').default,
			meta: { title: 'Modificar material'}
		},
		{
			path: 'show',
			name: 'materiales.show',
			component: require('./components/materiales/ShowComponent').default,
			meta: { title: 'Detalle de material'}
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
		meta: { title: 'Crear proveedor'}
	},
	{
		path: '/compras/:id',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'edit',
			name: 'compras.edit',
			component: require('./components/compras/EditComponent').default,
			meta: { title: 'Modificar proveedor'}
		},
		{
			path: 'show',
			name: 'compras.show',
			component: require('./components/compras/ShowComponent').default,
			meta: { title: 'Detalle de proveedor'}
		}
		]
	},
	]
})