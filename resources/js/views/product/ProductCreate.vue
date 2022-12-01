<template>
    <form class="col-sm-6">
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

        <button @click.prevent="createProduct" class="btn btn-primary mt-2">
            Создать
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
        this.getCategories();
    },
    methods: {
        createProduct() {
            this.response.status = null;
            this.response.message = null;

            axios.post(routes.create.product, this.form).then((response) => {
                if (response.data.status) {
                    this.response.status = true;
                    this.response.message = "Товар добавлен";

                    this.form.name = null;
                    this.form.price = null;
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
    },
};
</script>
