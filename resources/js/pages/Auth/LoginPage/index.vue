<template>
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-content">
						<h2 class="py-2">Sign In</h2>

						<p v-if="form.data && form.data.message" class="text-danger" v-html="form.data.message"></p>

						<form @submit.prevent="attemptLogin">
							<div class="form-group">
								<label for="email">Email</label>
								<input class="form-control" type="email" v-model="form.email" placeholder="Email" name="email" id="email">
								<p v-if="form.hasError('email')" class="text-danger">{{ form.hasError('email').message }}</p>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input class="form-control" type="password" v-model="form.password" placeholder="Password" name="password" id="password">
								<p v-if="form.hasError('password')" class="text-danger">{{ form.hasError('password').message }}</p>
							</div>

							<button class="btn btn-primary btn-block" type="submit">Sign In</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Form from '../../../utils/vue-form'

	export default {
		name: 'Login',
		guards: [
			'guest'
		],

		data() {
			return {
				form: new Form({
					email: '',
					password: ''
				})
			}
		},

		methods: {
			async attemptLogin() {
				const { data } = await this.form.post('/api/login')

				// Save the token.
				this.$store.dispatch('auth/saveToken', {
					token: data.token
				})

				// Fetch the user.
				await this.$store.dispatch('auth/fetchUser')

				// Redirect to home
				this.$router.push({ name: 'user.user-dashboard' })
			}
		},
	}
</script>
