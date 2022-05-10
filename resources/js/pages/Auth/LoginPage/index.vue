<template>
	<div class="container py-5">
		<div class="row">
			<div class="col-md-start-3 col-md-end-9">
                <div v-if="form.data && form.data.message" class="alert alert-danger mb-3" v-html="form.data.message"></div>

				<div class="card">
					<div class="card-content">
						<h2 class="py-2">Sign In</h2>

						<form @submit.prevent="attemptLogin">
							<!-- Email -->
							<div class="form-group py-3">
								<label for="email">Email</label>
								<input class="form-control" type="email" v-model="form.email" placeholder="Email" name="email" id="email">
								<small v-if="form.hasError('email')" class="text-danger">{{ form.hasError('email').message }}</small>
							</div>

							<!-- Password -->
							<div class="form-group py-3">
								<label for="password">Password</label>
								<input class="form-control" type="password" v-model="form.password" placeholder="Password" name="password" id="password">
								<small v-if="form.hasError('password')" class="text-danger">{{ form.hasError('password').message }}</small>
							</div>

							<!-- Remember Me -->
							<div class="form-group py-3">
								<input type="checkbox" id="remember" value="remember">
								<label for="remember" class="text-muted">Remember me</label>
							</div>

                            <!-- Submit Button -->
                            <v-button class="btn-block" :loading="form.busy" @click="form.busy = true">
                                Sign In
                            </v-button>
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
					password: '',
                    busy: false
				})
			}
		},

		methods: {
			async attemptLogin() {
				const { data } = await this.form.post('/api/login')

                // set the state
                this.form.busy = false

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
