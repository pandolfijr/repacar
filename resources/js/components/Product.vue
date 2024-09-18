<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <section class="section" style="margin-bottom: -7em; margin-top: 3.5em;">
            <div class="bg-white-100" style="padding-top: 2em;">
                <div class="container">
                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-6 text-center">
                            <form class="position-relative w-100" @submit.prevent="handleSubmit">
                                <div class="input-group mb-4">
                                    <input class="form-control shadow-none" type="text" name="search" v-model="filter"
                                        style="border-radius: 2em 0 0 2em; background-color: white;"
                                        placeholder="O que você está procurando?">
                                    <button type="button" class="btn shadow-none"
                                        style="border-radius: 0 2em 2em 0;background-color:white; border-color: #e3e9ef;"
                                        @click="getProducts()">
                                        <i class="fi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
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
                    <div v-if="Object.values(products).length > 0" class="row g-3"><!-- Product Box -->
                        <div v-for="product in products" :key="product.id" class="col-sm-6 col-lg-3">
                            <div class="product-card-1">
                                <div class="product-card-image">
                                    <div class="badge-ribbon">
                                        <span class="badge bg-success">Novo</span>
                                    </div>
                                    <div class="product-action">

                                        <a @click="openQuickView(product)" class="btn btn-outline-success">
                                            <i class="fi-eye"></i>
                                        </a>
                                    </div>
                                    <div class="product-media">
                                        <router-link :to="'/product/' + product.Cod + '/detail'">
                                            <div v-if="product.images.length > 0">
                                                <img v-if="product.images[0] && product.images[0].Caminho !== ''"
                                                    class="img-fluid product-image" :src="product.images[0].Caminho"
                                                    :alt="product.Produto" />
                                                <img v-else class="img-fluid" src="/public/assets/img/front/logo.png"
                                                    :alt="product.Produto" />
                                            </div>
                                        </router-link>
                                        <div class="product-cart-btn">
                                            <button @click="addToCart(product, product.quantity ?? 0)"
                                                class="btn btn-success btn-sm w-100">
                                                <i class="fi-shopping-cart"></i> Adicionar ao Carrinho
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card-info">
                                    <div class="product-meta small">Cód: {{ product.Codigo }}</div>
                                    <div class="product-title-container">
                                        <router-link :to="'/product/' + product.Cod + '/detail'">
                                            <h6 class="product-title">
                                                <a>{{ product.Produto }}</a>
                                            </h6>
                                        </router-link>
                                    </div>
                                </div>
                                <div class="product-card-info mt-3-negative">
                                    <span class="space-right" style=""> Qtd. {{ product.quantity ?
                                        product.quantity : '1' }}</span>
                                    <button @click="incrementQuantity(product)"
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        style="">
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

                    </div>
                    <div v-else-if="no_products" class="row g-2 g-sm-3 g-lg-4 text-center">
                        <h1>Nenhum produto encontrado...</h1>
                    </div>
                    <div v-else class="row g-2 g-sm-3 g-lg-4 text-center">
                        <h1>Carregando produtos...</h1>
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
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
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
            no_products: false,
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
                    if (this.products.length == 0) {
                        this.no_products = true;
                    }
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
            if (quantity === 0) {
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: 'Você não informou a quantidade',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
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

.product-media {
    justify-content: center;
    align-items: center;
    padding: 1em;
    background-color: #fff;
    /* Cor de fundo branco para a borda */
    border-radius: 8px;
    /* Ajuste a borda como necessário */
}

.product-image {
    max-width: 100%;
    max-height: 200px;
    /* Defina a altura máxima desejada */
    object-fit: contain;
    /* Ajusta a imagem para caber dentro da div sem distorcer */
    border-radius: 8px;
    /* Ajuste a borda como necessário */
    background-color: #fff;
    /* Cor de fundo branco para a borda */
    padding: 1.5em;
}

.space-right {
    margin-right: 1em;
}

.product-title-container {
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 6em;
    /* Define a altura fixa desejada */
    overflow-y: auto;
    /* Permite rolar o conteúdo excedente verticalmente */
}

.product-title {
    padding: 0 10px;
    /* Adicione padding para melhor espaçamento se necessário */

}

.product-title a {
    margin-top: -2.5em;
    display: block;
    /* Garante que o link ocupe toda a altura disponível */
    text-decoration: none;
    /* Remove a sublinha do link */
    color: inherit;
    /* Mantém a cor do texto */
}

.mt-3-negative {
    margin-top: -4em;
}
</style>
