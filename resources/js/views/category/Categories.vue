<template>
    <div class="row">
        <div
            class="card col-sm-3"
            style="width: 18rem"
            v-for="category in categories"
            :key="category.id"
        >
            <div class="card-body">
                <h5 class="card-title">{{ category.name }}</h5>
                <p class="card-text">Родитель: {{ category.parent_name }}</p>
                <div class="d-flex justify-content-between">
                    <router-link
                        :to="'categories/' + category.id + '/products'"
                        class="button"
                        >Товары</router-link
                    >
                    <router-link
                        :to="'category/update/' + category.id"
                        class="button"
                        >Редактировать</router-link
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { routes } from "../../api";

export default {
    data() {
        return {
            categories: null,
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios
                .get(routes.get.categories, {
                    params: this.$route.query,
                })
                .then((response) => {
                    this.categories = response.data;
                });
        },
    },
};
</script>
