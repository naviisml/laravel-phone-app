<template>
	<div class="container py-5">
		<div class="row">
			<div class="col-md-start-3 col-md-end-9">
                <div v-if="form.data && form.data.message" class="alert alert-danger mb-3" v-html="form.data.message"></div>

				<div class="card">
					<div class="card-content">
						<h2>Sign Up</h2>

						<form @submit.prevent="register">
							<!-- Username -->
							<div class="form-group py-3">
								<label for="username">Username</label>
								<input class="form-control" v-model="form.username" type="text" id="username" name="username" placeholder="Username">
								<small v-if="form.hasError('username')" class="text-danger">{{ form.hasError('username').message }}</small>
							</div>

							<!-- Email -->
							<div class="form-group py-3">
								<label for="email">Email</label>
								<input class="form-control" v-model="form.email" type="email" id="email" name="email" placeholder="example@email.com">
								<small v-if="form.hasError('email')" class="text-danger">{{ form.hasError('email').message }}</small>
							</div>

							<!-- Password -->
							<div class="form-group py-3">
								<label for="password">Password</label>
								<input class="form-control" v-model="form.password" type="password" id="password" name="password">
								<small v-if="form.hasError('password')" class="text-danger">{{ form.hasError('password').message }}</small>
							</div>

							<!-- Password Confirmation -->
							<div class="form-group py-3">
								<label for="password_confirmation">Confirm Password</label>
								<input class="form-control" v-model="form.password_confirmation" type="password" id="password_confirmation" name="password_confirmation">
								<small v-if="form.hasError('password_confirmation')" class="text-danger">{{ form.hasError('password_confirmation').message }}</small>
							</div>

							<!-- TOS -->
							<div class="form-group py-3">
								<input type="checkbox" id="tos" value="tos">
								<label for="tos" class="text-muted">I agree with the <span class="text-primary">Terms</span> and <span class="text-primary">Privacy</span> policy</label>
							</div>

				            <!-- Submit Button -->
                            <v-button class="btn-block" :loading="form.busy" @click="form.busy = true">
                                Register
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
		name: 'Register',
		guards: [
			'guest'
		],

		data () {
			return {
				form: new Form({
					username: '',
					email: '',
					password: '',
					password_confirmation: ''
				})
			}
		},

		methods: {
			async register () {
				// Register the user.
				const { data } = await this.form.post('/api/register')

				// Log in the user.
				const { data: { token } } = await this.form.post('/api/login')

				// Save the token.
				this.$store.dispatch('auth/saveToken', { token })

				// Update the user.
				await this.$store.dispatch('auth/updateUser', { user: data })

				// Redirect home.
				this.$router.push({ name: 'user.user-dashboard' })
			}
		}
	}
</script>
