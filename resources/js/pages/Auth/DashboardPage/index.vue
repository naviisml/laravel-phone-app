<template>
	<div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <h3>Translations</h3>
                        <p class="text-muted">This page contains all the translations that have been done through this service.</p>
                    </div>

                    <v-table endpoint="/api/logs/translation" :key="state" :data="['id', 'action', 'data', 'ip_filtered', 'created_at']">
                        <template v-slot:actions="{ entry }">
                            <td>
                                <v-button class="btn btn-soft btn-small btn-danger tooltip-left" aria-label="Delete" @click="this.delete(entry.id)">
                                    <i class="far fa-trash"></i>
                                </v-button>
                            </td>
                        </template>
                    </v-table>
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
                state: 1
            }
        },

        methods: {
            async delete(id) {
                const { status } = await axios.delete(`/api/log/${id}/delete`)

                // refresh the logs
                if (status == 200) {
			        this.state += 1
                }
            },
        }
	}
</script>
