<template>
    <form class="col-sm-6" v-if="form.name">
        <div class="form-group mt-3">
            <label>Название</label>
            <input type="text" class="form-control" v-model="form.name" />
        </div>
        <div class="form-group mt-3">
            <label>Цена</label>
            <input type="number" class="form-control" v-model="form.price" />
        </div>

        <div class="form-group mt-3" v-if="categories">
            <label>Категория</label>
            <select multiple class="form-control" v-model="form.categories">
                <option value="null" hidden>Выбрать категорию</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>

        <button @click.prevent="updateProduct" class="btn btn-primary mt-2">
            Обновить
        </button>
        <button @click.prevent="deleteProduct" class="btn btn-danger mt-2">
            Удалить
        </button>
    </form>

    <div
        v-if="response.message"
        role="alert"
        :class="[
            response.status ? 'alert-success' : 'alert-danger',
            'alert mt-3',
        ]"
    >
        {{ response.message }}
    </div>
</template>

<script>
import axios from "axios";
import { routes } from "../../api";

export default {
    data() {
        return {
            categories: null,
            form: {
                name: null,
                price: null,
                categories: null,
            },
            response: {
                status: null,
                message: null,
            },
        };
    },
    mounted() {
        this.getProduct();
        this.getCategories();
    },
    methods: {
        updateProduct() {
            this.response.status = null;
            this.response.message = null;

            axios
                .put(
                    routes.get.products + "/" + this.$route.params.id,
                    this.form
                )
                .then((response) => {
                    if (response.data.status) {
                        this.response.status = true;
                        this.response.message = "Товар обновлен";
                    } else {
                        this.response.status = false;
                        this.response.message = response.data;
                    }
                });
        },
        deleteProduct() {
            this.response.status = null;
            this.response.message = null;

            axios
                .delete(routes.get.products + "/" + this.$route.params.id)
                .then((response) => {
                    if (response.data.status) {
                        this.response.status = true;
                        this.response.message = "Товар удален";

                        this.form.name = null;
                        this.form.price = null;

                        setTimeout((_) => {
                            location.href = "/products";
                        }, 1000);
                    } else {
                        this.response.status = false;
                        this.response.message = response.data;
                    }
                });
        },
        getCategories() {
            axios.get(routes.get.categories).then((response) => {
                this.categories = response.data;
            });
        },
        getProduct() {
            axios
                .get(routes.get.products + "/" + this.$route.params.id)
                .then((response) => {
                    if (response.data.status === false) {
                        this.response.status = false;
                        this.response.message = response.data.message;
                    } else {
                        const product = response.data;
                        this.form.name = product.name;
                        this.form.price = product.price;
                    }
                });
        },
    },
};
</script>
