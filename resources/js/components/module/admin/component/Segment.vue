<template>
    <v-col class="setting-segment">
        <v-row class="setting-segment-title">
            <span>{{ this.title }}</span>
            <v-divider></v-divider>
        </v-row>
        <v-row>
            <slot/>
        </v-row>
    </v-col>
</template>

<script>
export default {
    props:['title'],
    setup() {

    },
}
</script>
