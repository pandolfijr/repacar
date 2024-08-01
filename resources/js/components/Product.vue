<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <section class="section" style="margin-bottom: -7em; margin-top: 8em;">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-6 text-center">
                        <form class="position-relative w-100">
                            <div class="mb-3 input-group">
                                <input class="form-control shadow-none" type="text" name="search" v-model="filter"
                                    placeholder="O que você está procurando?">
                                <button type="button" class="btn btn-success shadow-none" @click="getProducts()">
                                    <i class="fi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center section-heading">
                    <div v-if="full_category && full_category.SubCategoria && Object.values(full_category).length > 0"
                        class="col-lg-6 text-center">
                        <p class="fs-6 m-0">{{ full_category.Categoria }}</p>
                        <h3 class="h2 mt-2">{{ full_category.SubCategoria }}</h3>
                    </div>
                    <div v-else class="col-lg-6 text-center">
                        <p class="fs-6 m-0">Produtos</p>
                        <h3 class="h2 mt-2">{{ full_category.Categoria ? full_category.Categoria : 'Novos Produtos' }}
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div v-if="Object.values(products).length > 0" class="row g-2 g-sm-3 g-lg-4">
                        <div v-for="product in products" :key="product.id" class="col-6 col-md-4 col-lg-3">
                            <div class="product-card-1">
                                <div class="product-card-image">
                                    <div class="product-action">
                                        <a @click="openQuickView(product)" class="btn btn-outline-success">
                                            <i class="fi-eye"></i>
                                        </a>
                                    </div>
                                    <div class="product-media">
                                        <a @click="openQuickView(product)">
                                            <img v-if="product.images && product.images.Caminho !== ''"
                                                class="img-fluid" :src="product.images.Caminho" style=""
                                                :alt="product.Produto">
                                            <img v-else class="img-fluid" src="/public/assets/img/front/logo.png"
                                                style="" :alt="product.Produto">
                                        </a>
                                        <div class="product-cart-btn">
                                            <button @click="addToCart(product, product.quantity ?? 1)"
                                                class="btn btn-success btn-sm w-100">
                                                <i class="fi-shopping-cart"></i> Adicionar ao Carrinho
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card-info">
                                    <div class="product-meta small">Cód: {{ product.Codigo }}</div>
                                    <h6 class="product-title">
                                        <a @click="openQuickView(product)">{{ product.Produto }}</a>
                                    </h6>
                                    <!-- <div class="product-price">
                                            <span class="text-success"> R$ {{ product.Valor }} valor<small></small>
                                            </span>
                                        </div> -->
                                </div>

                                <div class="product-card-info">
                                    <span class="" style="margin-right: 1em;"> Qtd. {{ product.quantity ?
                                        product.quantity : '1' }}</span>
                                    <button @click="incrementQuantity(product)"
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        style="margin-right: 0em;">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                    <button @click="decrementQuantity(product)"
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        :disabled="product.quantity <= 1 || !product.quantity">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <button
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        @click="removeProduct(product.Cod)">
                                        <i class="bi bi-trash custom-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <QuickView v-if="selectedProduct" :product="selectedProduct" @close="selectedProduct = null"
                            :cart="cart" @add-to-cart="addToCart" @remove-product="removeProduct"
                            @load-products="loadProductsFromLocalStorage" @increment-quantity="incrementQuantity"
                            @decrement-quantity="decrementQuantity">
                        </QuickView>
                    </div>
                    <div v-else class="row g-2 g-sm-3 g-lg-4 text-center">
                        <h1>Nenhum produto encontrado</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- End blog -->
    </main>
    <!-- <footer-site></footer-site> -->
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import QuickView from './modal/QuickView.vue';
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';
import Carousel from './Carousel.vue';

export default {
    data: function () {
        return {
            products: {},
            cart: [],
            filter: '',
            selectedProduct: null,
            category: this.$route.params.category ? this.$route.params.category : '',
            sub: this.$route.params.sub ? this.$route.params.sub : '',
            category: {},
            full_category: {},
        };
    },
    computed: {

    },
    components: {
        QuickView,
        MiniCart,
        AppMenu,
        Carousel
    },
    methods: {
        getProducts() {
            axios.get('/product', {
                params: {
                    CodCat: this.$route.params.category,
                    CodSubCat: this.$route.params.sub,
                    filter: this.filter
                }
            })
                .then(response => {
                    this.products = response.data.products.products;
                })
                .catch(error => {
                    console.error('Houve um problema com a requisição:', error);
                });
        },
        getCategory() {
            let url = '/category/' + this.$route.params.category;
            if (this.sub != '') {
                url = '/subcategory/' + this.$route.params.sub;
            }
            axios.get(url)
                .then(response => {
                    console.log('responmsee', response.data);
                    this.full_category = response.data.category.category;
                })
                .catch(error => {
                    console.error('Houve um problema com a requisição:', error);
                });
        },
        openQuickView(product) {
            this.selectedProduct = product;
            this.$nextTick(() => {
                $('#px-quick-view').modal('show');
            });
        },
        addToCart(product, quantity) {
            const { Cod, Entrada, Codigo, Produto, NCM, Embalagem, Grupo, Peso, unidade, desativado, TipoPSO, origem, FabricacaoPropria, CodEFO, ProdPesavel, CodCat, CodSubCat, UnidadeTrib, images, stock } = product;
            const productToAdd = { Cod, Entrada, Codigo, Produto, NCM, Embalagem, Grupo, Peso, unidade, desativado, TipoPSO, origem, FabricacaoPropria, CodEFO, ProdPesavel, CodCat, CodSubCat, UnidadeTrib, images, quantity: quantity, stock };
            let products = JSON.parse(localStorage.getItem('cart')) || [];
            const existingProductIndex = products.findIndex(p => p.Cod === productToAdd.Cod);
            if (existingProductIndex !== -1) {
                products[existingProductIndex].quantity += productToAdd.quantity;
            } else {
                products.push(productToAdd);
            }
            localStorage.setItem('cart', JSON.stringify(products));
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: 'Produto adicionado ao carrinho',
                showConfirmButton: false,
                timer: 2000
            });
            this.loadProductsFromLocalStorage();
        },
        removeProduct(productCod) {
            const productsString = localStorage.getItem("cart");
            if (productsString) {
                let products = JSON.parse(productsString);
                const productIndex = products.findIndex(product => product.Cod === productCod);
                if (productIndex !== -1) {
                    products.splice(productIndex, 1);
                    localStorage.setItem("cart", JSON.stringify(products));
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: 'Produto removido do carrinho',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: 'Nada à remover! Este produto não está no carrinho.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }

            this.loadProductsFromLocalStorage();
        },
        incrementQuantity(product) {
            console.log(product);
            if (typeof product.quantity !== 'number' || isNaN(product.quantity)) {
                product.quantity = 1;
            }
            product.quantity++;
            this.loadProductsFromLocalStorage();
        },
        decrementQuantity(product) {
            if (product.quantity > 1) {
                product.quantity--;
            }
            this.loadProductsFromLocalStorage();
        },
        loadProductsFromLocalStorage() {
            const storedData = localStorage.getItem('cart');
            if (storedData) {
                const parsedData = JSON.parse(storedData);
                this.cart = parsedData;
            } else {
                this.cart = {};
            }
            console.log(this.cart);
        },
        clearCart() {
            localStorage.clear();
            this.cart = {};
        },
    },
    beforeMount() {
        this.getProducts();
        this.loadProductsFromLocalStorage();
        this.getCategory();
        console.log('sub', this.$route.params.sub);
        console.log('category', this.$route.params.category);
    },
};
</script>

<style>
.select-container {
    position: relative;
}

.select-container i {
    position: absolute;
    top: 50%;
    right: 1em;
    transform: translateY(-50%);
    pointer-events: none;
    color: var(--bs-gray-700);
}

.login {
    border-color: #434a57;
    border-radius: 4em;
    padding: 0.1em 1.5em;
    height: 2em;
    font-size: 1em;
    margin-top: -1em;
}

.custom-btn {
    padding: 0.25em;
    width: 2em;
    height: 2em;
    align-items: center;
    justify-content: center;
    background-color: #079241;
    border: none;
    color: white;
}

.custom-btn:hover {
    background-color: #07642e;
}

.custom-btn:disabled {
    background-color: #07642e;
}

.custom-icon {
    font-size: 1.2em;
    color: white;
}

.padding-button {
    margin-left: 0.15rem !important;
}
</style>
