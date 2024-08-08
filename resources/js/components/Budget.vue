<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>

        <section class="section" style=" margin-top: 7em;">
            <div class="container" style="background-color: white;">
                <div class="row gy-4"  style="background-color: white;"><!-- Itens do Carrinho -->
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center pb-4 border-bottom mb-4">
                            <h2 class="h5 mb-0">Produtos</h2>
                            <router-link :to="'/'">
                                <button class="btn btn-outline-success btn-sm ps-2" href="shop-grid-ls.html"><i
                                        class="ci-arrow-left me-2"></i>Continuar comprando</button></router-link>
                        </div><!-- Item-->
                        <div v-if="typeof (cart) === 'object' && Object.values(cart).length > 0">
                            <div v-for="product in cart"
                                class="d-flex align-items-center flex-row w-100 pb-3 mb-3 border-bottom">
                                <a class="d-inline-block flex-shrink-0 me-3" href="#">
                                    <img v-if="product.images && product.images[0].Caminho !== ''" class="img-default-product"
                                        :src="product.images[0].Caminho" :alt="product.Produto">
                                    <img v-else class="img-default-product" src="/public/assets/img/front/logo.png"
                                        :alt="product.Produto">
                                </a>
                                <div class="d-flex flex-column flex-sm-row col">
                                    <div class="pe-sm-2">
                                        <h3 class="product-title fs-5 mb-1">
                                            <p><span class="text-reset" href="#">{{ product.Produto }}</span></p>
                                        </h3>
                                        <div class="row">
                                            <div class="col-9" style="padding-left: 1.5em; margin-top:-1em;">
                                                <div class="d-flex align-items-center">
                                                    <span class="text-body"><b>Cód:</b> {{ product.Codigo }}</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="margin-top:-1em">
                                                    <span class="text-body"><b>Quantidade:</b> {{ product.quantity }} |
                                                    </span>
                                                    <button class="btn btn-link px-0 text-success" type="button"
                                                        style="" @click="removeProduct(product.Cod)">
                                                        <i class="bi-trash3 me-2"></i>
                                                        <span>Remover</span>
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="col-3">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-2 pt-sm-0 d-flex d-sm-block ms-sm-auto">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h6 class="me-2 text-body">Nenhum produto no carrinho</h6>
                        </div>


                        <!-- Item-->
                    </div><!-- Barra lateral do carrinho -->
                    <div class="col-lg-4 ps-xl-7" ><!-- Estimativas de Envio -->
                        <div class="card" style="background-color: white;">
                            <div class="card-header bg-transparent py-3">
                                <h6 class="m-0 h5">Total do Pedido</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-0 pt-2 mt-2 border-top fw-bold text-mode"
                                    style="padding-bottom: 2em;">
                                    <div class="col-8">
                                        <span class="text-mode">Quantidade de Itens</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="ml-auto">{{ typeof (cart) === 'object' &&
                                            Object.values(cart).length > 0 ?
                                            sumQuantities() : 0 }}</span>
                                    </div>
                                </div>
                                <!-- <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="me-2 text-body">Subtotal</h6><span class="text-end">$265.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="me-2 text-body">Impostos</h6><span class="text-end">$265.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Total Geral</h6><span class="text-end text-mode">$265.00</span>
                                    </li>
                                </ul> -->
                                <!-- <div class="pt-2 pb-4">
                                    <div class="d-flex"><input type="text" name="promo" placeholder="Aplicar código promocional" class="form-control form-control-sm"> <button class="btn btn-dark btn-sm ms-2">Aplicar</button></div>
                                </div> -->
                                <div class="text-center pt-4">
                                    <router-link :to="'checkout'">
                                        <button class="btn btn-block btn-success w-100 mb-3"
                                            :disabled="(typeof (cart) !== 'object' || Object.values(cart).length == 0)">
                                            <i class="bi-credit-card-2-back me-2"></i> Prosseguir para o
                                            Checkout</button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
</template>

<script>
import Swal from 'sweetalert2';
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';

export default {
    data: function () {
        return {
            cart: [],
        };
    },
    computed: {

    },
    components: {
        MiniCart,
        AppMenu,
    },
    methods: {
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
            const productToAdd = { Cod, Entrada, Codigo, Produto, NCM, Embalagem, Grupo, Peso, unidade, desativado, TipoPSO, origem, FabricacaoPropria, CodEFO, ProdPesavel, CodCat, CodSubCat, UnidadeTrib, images, stock, quantity: quantity };
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
        },
        clearCart() {
            localStorage.clear();
            this.cart = {};
        },
        sumQuantities() {
            return this.cart.reduce((total, item) => total + item.quantity, 0) ?? 0;
        }
    },
    beforeMount() {
        this.loadProductsFromLocalStorage();
    },

};
</script>

<style>
.img-default-product {
    height: 7em;
    width: 7em;
}
</style>
