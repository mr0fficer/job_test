<template>
    <Header />
    <div class="container mt-3">
        <router-view></router-view>
    </div>
</template>

<script>
import Header from "./Header.vue";

export default {
    components: { Header },
};
</script>
