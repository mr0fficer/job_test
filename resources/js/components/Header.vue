<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <router-link
                    v-for="router in routes.filter(
                        (router) => router.show_navbar
                    )"
                    :key="router.path"
                    :to="router.path"
                    v-slot="{ navigate, isActive }"
                >
                    <li class="nav-item">
                        <a
                            :href="router.path"
                            @click="navigate"
                            :class="[isActive ? 'active' : '', 'nav-link']"
                            >{{ router.name }}</a
                        >
                    </li>
                </router-link>
            </ul>
        </div>
    </nav>
</template>

<script>
import { routes } from "../router";

export default {
    data() {
        return {
            routes: routes,
        };
    },
};
</script>
