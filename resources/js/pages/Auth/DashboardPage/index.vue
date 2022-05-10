<template>
	<div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        Welcome!
                    </div>
                    <span v-if="logs">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Text</th>
                                        <th>Number</th>
                                        <th>Created at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="log in logs" :key="log.id">
                                        <td>{{ log.id }}</td>
                                        <td>{{ log.data.input }}</td>
                                        <td>{{ log.data.output }}</td>
                                        <td>{{ log.created_at }}</td>
                                        <td>
                                            <v-button class="btn btn-soft btn-small btn-danger tooltip-left" aria-label="Delete" :loading="form.busy" @click="this.delete(log.id)">
                                                <i class="far fa-trash"></i>
                                            </v-button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Controls -->
                        <div class="table-controls p-3">
                            <div class="d-flex">
                                <p class="text-muted">Page {{ page }} / {{ last_page }}</p>

                                <!-- Table Actions -->
                                <div class="ml-auto">
                                    <v-button class="btn btn-soft" :loading="busy" @click="previousPage">
                                        <i class="far fa-long-arrow-left"></i>
                                    </v-button>
                                    <v-button class="btn btn-soft" :loading="busy" @click="nextPage">
                                        <i class="far fa-long-arrow-right"></i>
                                    </v-button>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
    import axios from 'axios'

	export default {
		name: 'Dashboard',
        guards: ['auth'],

        data() {
            return {
                form: {
                    busy: false
                },
                logs: false,
                page: 1,
                last_page: 1,
                busy: false
            }
        },

		mounted () {
			this.getData(this.page)
		},

		methods: {
			async getData (page) {
                const { data } = await axios.get(`/api/logs/translation?page=${page}`)

                this.busy = false
				this.logs = data.data
				this.page = data.current_page
				this.last_page = data.last_page
			},
			setPage(page) {
				if (page <= 0 || page > this.last_page) {
                    this.busy = false

					return false, console.error(`Page ${page} doesn't exist.`)
				}
				this.getData(page)
			},
			previousPage() {
                this.busy = true

				this.setPage(this.page - 1)
			},
			nextPage() {
                this.busy = true

				this.setPage(this.page + 1)
			},
            async delete(id) {
                const { data, status } = await axios.delete(`/api/log/${id}/delete`)

                console.log(data)
                if (status == 200) {
			        this.getData(this.page)
                }
            },
		}
	}
</script>

<style scoped>
.table-responsive {
    overflow: auto;
}

.table-responsive .table-controls {
    position: absolute;
}
</style>
