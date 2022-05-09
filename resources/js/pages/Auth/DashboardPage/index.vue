<template>
	<div class="container py-5">
        Welcome!

        <table v-if="logs">
            <tr>
                <th>Input</th>
                <th>Output</th>
                <th>Created at</th>
            </tr>
            <tr v-for="log in logs" :key="log.id">
                <td>{{ log.data.input }}</td>
                <td>{{ log.data.output }}</td>
                <td>{{ log.data.created_at }}</td>
            </tr>
        </table>
	</div>
</template>

<script>
    import axios from 'axios'

	export default {
		name: 'Dashboard',
        guards: ['auth'],

        data() {
            return {
                logs: false,
            }
        },

        mounted() {
            this.getLogs()
        },

        methods: {
            async getLogs() {
                const { data } = await axios.get('/api/parser/logs')

                this.logs = data.data
            }
        }

	}
</script>
