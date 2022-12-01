<template>
    <form class="col-sm-6" v-if="form.name">
        <div class="form-group mt-3">
            <label>Название</label>
            <input type="text" class="form-control" v-model="form.name" />
        </div>

        <div class="form-group mt-3" v-if="categories">
            <label>Родительская категория</label>
            <select class="form-control" v-model="form.parent_id">
                <option value="0">Без родителя</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>

        <button @click.prevent="updateCategory" class="btn btn-primary mt-2">
            Обновить
        </button>
        <button @click.prevent="deleteCategory" class="btn btn-danger mt-2">
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
                parent_id: 0,
            },
            response: {
                status: null,
                message: null,
            },
        };
    },
    mounted() {
        this.getCategory();
        this.getCategories();
    },
    methods: {
        updateCategory() {
            this.response.status = null;
            this.response.message = null;

            axios
                .put(
                    routes.get.categories + "/" + this.$route.params.id,
                    this.form
                )
                .then((response) => {
                    if (response.data.status) {
                        this.response.status = true;
                        this.response.message = "Категория обновлена";
                    } else {
                        this.response.status = false;
                        this.response.message = response.data;
                    }
                });
        },
        deleteCategory() {
            this.response.status = null;
            this.response.message = null;

            axios
                .delete(routes.get.categories + "/" + this.$route.params.id)
                .then((response) => {
                    if (response.data.status) {
                        this.response.status = true;
                        this.response.message = "Категория удалена";

                        this.form.name = null;
                        this.form.price = null;

                        setTimeout((_) => {
                            location.href = "/categories";
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
        getCategory() {
            axios
                .get(routes.get.categories + "/" + this.$route.params.id)
                .then((response) => {
                    if (response.data.status === false) {
                        this.response.status = false;
                        this.response.message = response.data.message;
                    } else {
                        const category = response.data;
                        this.form.name = category.name;
                        this.form.parent_id = category.parent_id;
                    }
                });
        },
    },
};
</script>
