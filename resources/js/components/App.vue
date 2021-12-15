<template>
    <v-app>
        <router-view></router-view>

        <v-snackbar
            v-model="snackbar.show"
        >
            {{ snackbar.msg }}

            <template v-slot:action="{ attrs }">
                <v-btn
                    color="blue"
                    text
                    v-bind="attrs"
                    @click="hideSnackbar"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>

        <v-overlay :value="is_busy">
            <div class="text-center card bg-white p-3">
                <v-progress-circular
                :size="50"
                color="primary"
                indeterminate
                ></v-progress-circular>
            </div>
        </v-overlay>
    </v-app>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

export default {
    computed: {
        ...mapGetters(['is_busy', 'snackbar'])
    },
    methods: {
        ...mapMutations(['hideSnackbar'])
    }
}
</script>

<style>
/* use custom style */
    @import url('/css/app.css');
</style>
