// state
export const state = {
	history: JSON.parse(localStorage.getItem('history')) || []
}

// getters
export const getters = {
	history: state => state.history
}

// mutations
export const mutations = {
	["HISTORY_ADD"] (state, { object }) {
        if (object == null) return

		let list = state.history.reverse() || []

        // add item
        list.push(object)
        list.reverse()

        // reset items to 5
        if (list.length >= 4)
            list.length = 4

        // set the new item
        state.history = list
		localStorage.setItem('history', JSON.stringify(list))
	},

	["HISTORY_REMOVE"] (state, { id }) {
		let list = state.history || []

        // remove the item
        list.splice(id, 1);

        // set the new item
		localStorage.setItem('history', JSON.stringify(list))
	},
}

// actions
export const actions = {
    /**
     * Add a history entry
     *
     * @param   {function}  commit
     * @param   {object}  payload
     *
     * @return  {void}
     */
	addEntry ({ commit }, payload) {
		commit("HISTORY_ADD", payload)
	},
    /**
     * Remove a history entry
     *
     * @param   {function}  commit
     * @param   {object}  payload
     *
     * @return  {void}
     */
    removeEntry ({ commit }, payload) {
		commit("HISTORY_REMOVE", payload)
	},
}

export const namespaced = true
