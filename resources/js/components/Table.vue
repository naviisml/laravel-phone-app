<template>
	<div v-if="data">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th v-for="type in data" :key="type">{{ type }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="entry in result" :key="entry.id">
                        <td v-for="type in data" :key="type">
                            <span class="badge mr-2" v-if="typeof entry[type] == 'object'" v-for="(value, key) in entry[type]" :key="value.id">
                                {{ key }}: {{ value }}
                            </span>
                            <p v-else>
                                {{ entry[type] }}
                            </p>
                        </td>
                        <slot name="actions" v-bind:entry="entry" v-bind:refreshTable="refreshTable"></slot>
                    </tr>
                </tbody>
            </table>
        </div>
		<!-- Table Controls -->
		<div class="p-3">
			<div class="d-flex">
				<p class="text-muted">Page {{ current_page }} / {{ last_page }}</p>

				<!-- Table Actions -->
				<div class="ml-auto">
					<button class="btn btn-soft" @click="previousPage">
						<i class="far fa-long-arrow-left"></i>
					</button>
					<button class="btn btn-soft" @click="nextPage">
						<i class="far fa-long-arrow-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: 'VTable',

		props: {
			endpoint: {
				type: String,
				default: null
			},
			page: {
				type: Number,
				default: 1
			},
			data: {
				type: Array,
				default: []
			}
		},

		data () {
			return {
				last_page: 0,
				result: null,
				current_page: 1,
			}
		},

		created () {
			this.current_page = this.page
			this.getData(this.current_page)
		},

		methods: {
			async getData (page) {
				const url = this.endpoint + '?page=' + page
				const { data } = await axios.get(url)

				this.result = data.data
				this.current_page = data.current_page
				this.last_page = data.last_page
			},
			previousPage() {
				this.setPage(this.current_page - 1)
			},
			nextPage() {
				this.setPage(this.current_page + 1)
			},
            refreshTable() {
				this.getData(this.current_page)
            },
			setPage(page) {
				if (page <= 0 || page > this.last_page) {
					return false, console.error(`Page ${page} doesn't exist.`)
				}
				this.getData(page)
			}
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
