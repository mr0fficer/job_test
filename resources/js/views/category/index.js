import Categories from './Categories.vue'
import CategoryCreate from './CategoryCreate.vue'
import CategoryUpdate from './CategoryUpdate.vue'
import CategoryProducts from './CategoryProducts.vue'

const routes = [{
        path: '/categories',
        name: 'Категории',
        component: Categories,
        show_navbar: true
    },
    {
        path: '/categories/create',
        name: 'Создать категорию',
        component: CategoryCreate,
        show_navbar: true
    },
    {
        path: '/category/update/:id',
        component: CategoryUpdate,
        show_navbar: false
    },
    {
        path: '/categories/:id/products',
        component: CategoryProducts,
        show_navbar: false
    }
]

export default routes