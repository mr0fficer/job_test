<template>
    <div class="row" v-if="products">
                    <div
            class="card col-sm-3"
            style="width: 18rem"
            v-for="product in products"
            :key="product.id"
        >
            <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <p class="card-text">Цена: {{ product.price }}</p>
                <p class="card-text">Категории:  
                <ul>
                    <li v-for="category in product.categories" :key="category.id">{{category.name}}</li>
                </ul>
                </p>
               
                <div class="d-flex justify-content-between">
                    <router-link :to="'products/' + product.id" class="button"
                        >Посмотреть</router-link
                    >
                    <router-link
                        :to="'products/update/' + product.id"
                        class="button"
                        >Редактировать</router-link
                    >
                </div>
            </div>
        </div>
    </div>
    <div v-if="response.message" role="alert" class="alert-danger alert mt-3">
        {{ response.message }}
    </div>
</template>

<script>
import axios from "axios";
import { routes } from "../../api";

export default {
    data() {
        return {
            products: null,
            category_id: this.$route.params.id,
            response: {
                message: null,
            },
        };
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts() {
            axios
                .get(routes.get.categories_products(this.category_id), {
                    params: this.$route.query,
                })
                .then((response) => {
                    this.products = response.data;
                    if (!this.products.length) {
                        this.response.message = "Товаров не найдено";
                    }
                });
        },
    },
};
</script>
