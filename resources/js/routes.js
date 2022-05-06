function Container (path) {
	return () => import(/* webpackChunkName: '' */ `./pages/${path}`).then(m => m.default || m)
}

export const routes = [
	{
		path: '/',
		name: 'home',
		component: Container('HomePage')
	},
]
