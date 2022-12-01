const routes = {
    get: {
        products: "/api/products",
        categories: "/api/categories",
        categories_products: id => {
            return `/api/categories/${id}/products`
        },
    },
    create: {
        product: "/api/products",
        category: "/api/categories",
    }
}

export {
    routes
}