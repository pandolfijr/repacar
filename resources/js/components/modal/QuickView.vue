<template>
    <div class="modal-quick-view modal fade" id="px-quick-view" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <button class="btn-close position-absolute end-0 top-0 me-2 mt-2 z-index-1" type="button"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-3">
                    <div class="row text-center" style="">
                        <!-- Galeria de Produtos -->
                        <div class="col-lg-6 lightbox-gallery product-gallery d-flex justify-content-center align-items-center" style="padding:5em;">
                            <img v-if="product.images && product.images[0].Caminho !== ''" class="img-fluid"
                                :src="product.images[0].Caminho" :alt="product.Produto">
                            <img v-else class="img-fluid" src="/public/assets/img/front/logo.png"
                                :alt="product.Produto">
                        </div>
                        <!-- Fim da Galeria de Produtos -->
                        <!-- Detalhes do Produto -->
                        <div class="col-lg-6">
                            <div class="product-detail pt-4" style="margin-top:8em">
                                <div class="products-brand pb-2">
                                    <span>{{ product.marca }}</span>
                                </div>
                                <div class="products-title mb-2">
                                    <h1 class="h4">{{ product.Produto }}</h1>
                                </div>
                                <div class="product-description">
                                    <p></p>
                                </div>
                                <!-- <div class="product-price fs-3 fw-500 mb-2"> -->
                                <!-- <del class="text-muted fs-6">$38. <small>50</small>
                                    </del> -->
                                <!-- <span class="text-success">R$Valor <small></small>
                                    </span> -->
                                <!-- </div> -->

                                <div class="product-card-info">
                                    <span class="" style="margin-right: 1em;"> Qtd. {{ product.quantity ?
                                        product.quantity : '0' }}</span>
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
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button">
                                        <i class="bi bi-trash custom-icon"></i>
                                    </button>
                                </div>
                                <div class="product-detail-actions text-center" style="margin-top: 7em;">
                                    <div class="cart-button mb-3 text-center">
                                        <button @click="addToCart(product, product.quantity ?? 1)"
                                            class="btn btn-success btn-block">
                                            <i class="fi-shopping-cart"></i> Adicionar ao Carrinho
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim dos Detalhes do Produto -->
                    </div>
                </div>
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
        product: '',
        cart: ''
    },
    data: function () {
        return {

        };
    },
    computed: {

    },
    components: {

    },
    methods: {
        addToCart(product, quantity) {
            this.$emit('add-to-cart', product, quantity);
        },
        removeProduct(productCod) {
            this.$emit('remove-product', productCod);
            this.loadProductsFromLocalStorage();
        },
        incrementQuantity(product) {
            console.log('oie');
            this.$emit('increment-quantity', product);
            this.loadProductsFromLocalStorage();
        },
        decrementQuantity(product) {
            this.$emit('decrement-quantity', product);
            this.loadProductsFromLocalStorage();
        },
        loadProductsFromLocalStorage() {
            this.$emit('load-products');
        }


    },
    beforeMount() {

    },
};
</script>
<style>
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
