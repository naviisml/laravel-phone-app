function Container (path) {
	return () => import(/* webpackChunkName: '' */ `./pages/${path}`).then(m => m.default || m)
}

export const routes = [
	{
		path: '/',
		name: 'home',
		component: Container('HomePage')
	},

	{
		path: '/login',
		name: 'login',
		component: Container('Auth/LoginPage')
	},

	{
		path: '/register',
		name: 'register',
		component: Container('Auth/RegisterPage')
	},

	{
		path: '/user/user-dashboard',
		name: 'user.user-dashboard',
		component: Container('Auth/DashboardPage')
	},
]
