<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="modalMiniCart" aria-labelledby="modalMiniCartLabel">
        <div class="offcanvas-header border-bottom">
            <h6 class="offcanvas-title" id="modalMiniCartLabel">Seu Carrinho</h6>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled m-0 p-0">
                <li class="py-2">
                    <div v-if="cart && typeof (cart) === 'object' && Object.values(cart).length > 0">
                        <div v-for="product in cart" class="row align-items-center">
                            <div class="col-4">
                                <!-- Imagem -->
                                <a href="#">
                                    <img v-if="product.images && product.images.Caminho !== ''" class="img-fluid"
                                        :src="product.images.Caminho" :alt="product.Produto">
                                    <img v-else class="img-fluid" src="/public/assets/img/front/logo.png"
                                        :alt="product.Produto">
                                </a>
                            </div>
                            <div class="col-8">
                                <!-- Título -->
                                <p class="mb-2">
                                    <a class="text-mode fw-500" href="#">{{ product.Produto }}</a>
                                    <!-- <span class="m-0 text-muted w-100 d-block">R$ 40,00</span> -->
                                </p>
                                <!-- Rodapé -->
                                <div class="d-flex align-items-center">
                                    <div class="product-card-info">
                                        <div class="product-meta small" style="margin-top:-0.5em;margin-bottom:-0.7em;">
                                            Cód: {{ product.Codigo }}</div>
                                        <span class="" style="margin-right: 1em;"> Qtd. {{ product.quantity ?
                                            product.quantity : '1' }}</span>
                                        <!-- <button
                                            class="btn btn-success btn-sm" @click="removeProduct(product.Cod)">
                                            <i class="bi bi-x"></i> Remover
                                        </button> -->
                                        <button class="btn btn-link text-success ms-auto"
                                            @click="removeProduct(product.Cod)">
                                            <i class="bi-trash3 me-2"></i>
                                            <span>Remover</span>
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="col-12">
                            <p class="mb-2">
                                Não há nenhum produto no carrinho.
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-footer  p-3">
            <!-- <div class="row g-0 py-2">
                <div class="col-8">
                    <span class="text-mode">Sub-total</span>
                </div>
                <div class="col-4 text-end">
                    <span class="ml-auto">R$ 89.00</span>
                </div>
            </div>
            <div class="row g-0 py-2">
                <div class="col-8">
                    <span class="text-mode">Taxas:</span>
                </div>
                <div class="col-4 text-end">
                    <span class="ml-auto">R$ 89.00</span>
                </div>
            </div> -->
            <div class="row g-0 pt-2 mt-2 border-top fw-bold text-mode">
                <div class="col-8">
                    <span class="text-mode">Quantidade de Itens</span>
                </div>
                <div class="col-4 text-end">
                    <span class="ml-auto">{{ typeof (cart) === 'object' && Object.values(cart).length > 0 ?
                        sumQuantities() : 0 }}</span>
                </div>
            </div>
            <div class="pt-4">
                <router-link :to="'/checkout'">
                    <button class="btn btn-block btn-success w-100 mb-3" href="#">Continue com o Pedido</button>
                </router-link>
                <router-link :to="'/budget'">
                    <button class="btn btn-block btn-outline-mode w-100 mb-3" href="#">Ver Carrinho</button>
                </router-link>
                <button class="btn btn-block btn-outline-mode w-100 mb-3" @click="clearCart()">Limpar Carrinho</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

// import Menu from './Menu.vue';
// import Search from './Search.vue';
// import Footer from './Footer.vue';

export default {
    props: {
        cart: ''
    },
    data: function () {
        return {
            product: {
                id: '',
                name: '',
                price: '',
                quantity: '',
            }
        };
    },
    computed: {

    },
    components: {

    },
    methods: {
        getProperties() {

        },
        removeProduct(productCod) {
            this.$emit('remove-product', productCod);
        },
        loadProductsFromLocalStorage() {
            const storedData = localStorage.getItem('cart');
            if (storedData) {
                const parsedData = JSON.parse(storedData);
                this.cart = parsedData;
            } else {
                this.cart = {};
            }
        },
        clearCart() {
            this.$emit('clear-cart');
        },
        sumQuantities() {
            return this.cart.reduce((total, item) => total + item.quantity, 0) ?? 0;
        }

    },
    beforeMount() {

    },
};
</script>
