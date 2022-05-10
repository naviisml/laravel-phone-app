<template>
	<div class="container py-5">
        <h3 class="py-2">Characters</h3>
        <p class="text-muted">These are our Star Wars records, being updated every hour with new or existing character information.</p>

        <div v-if="characters && characters.length >= 1">
            <div class="row">
                <div v-for="(character, key) in characters" :key="key" class="col-md-4 py-2">
                    <div class="card">
                        <div class="card-content">
                            <strong>{{ character.name }}</strong>
                            <p>Played in {{ character.films.length }} movies</p>

                            <router-link class="btn" :to="{ name: 'character', params: { id: character.id } }">
                                Read more <i class="fas fa-long-arrow-right"></i>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: 'Characters',

        data() {
            return {
                page: 1,
                characters: []
            }
        },

        created() {
            this.get(this.page);
        },

        methods: {
            /**
             * Retrieve the list of characters
             *
             * @param   {string}  page
             *
             * @return  {void}
             */
            async get(page = 1) {
                const { data } = await axios.get(`/api/sw/characters?page=${page}`)

                this.characters.push(...data.data)
            },
        }

	}
</script>
