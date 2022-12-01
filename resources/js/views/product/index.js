import Product from './Product.vue'
import Products from './Products.vue'
import ProductCreate from './ProductCreate.vue'
import ProductUpdate from './ProductUpdate.vue'

const routes = [{
        path: '/products',
        name: 'Товары',
        component: Products,
        show_navbar: true
    },
    {
        path: '/products/:id',
        component: Product,
        show_navbar: false
    },
    {
        path: '/products/create',
        name: 'Создать товар',
        component: ProductCreate,
        show_navbar: true
    },
    {
        path: '/products/update/:id',
        component: ProductUpdate,
        show_navbar: false
    },
]

export default routes