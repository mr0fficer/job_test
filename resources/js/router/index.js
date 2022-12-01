import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import product_routes from '../views/product'
import category_routes from '../views/category'

let routes = [{
    path: '/',
    name: 'Главная',
    component: Home,
    show_navbar: true
}]

routes = [...routes, ...product_routes, ...category_routes]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export {
    routes,
    router
}