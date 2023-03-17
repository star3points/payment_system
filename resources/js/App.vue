<template>
    <router-view v-slot="{Component, route}">
        <component :is="Component" :key="route.path"/>
    </router-view>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import {useRouter} from "vue-router";

export default defineComponent({
    name: 'App',
    setup: () => {
        const router = useRouter();
    }
})
</script>

<style scoped>

</style>
