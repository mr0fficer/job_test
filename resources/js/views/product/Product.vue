<template>
    <div v-if="product">
        <h1>{{ product.name }}</h1>
        <p>Цена: {{ product.price }}</p>
    </div>

    <div class="alert alert-danger" role="alert" v-if="error_message">
        {{ error_message }}
    </div>
</template>

<script>
import axios from "axios";
import { routes } from "../../api";

export default {
    data() {
        return {
            product: null,
            error_message: null,
        };
    },
    mounted() {
        this.getProduct();
    },
    methods: {
        getProduct() {
            axios
                .get(routes.get.products + "/" + this.$route.params.id)
                .then((response) => {
                    if (response.data.status === false) {
                        this.error_message = response.data.message;
                    } else {
                        this.product = response.data;
                    }
                });
        },
    },
};
</script>
