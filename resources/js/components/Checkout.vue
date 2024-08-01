<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>

        <section class="section" style="margin-top: 8em">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-md-7">
                        <!-- Form -->
                        <form>
                            <!-- Heading -->
                            <h6 class="mb-4 h3">Detalhes do Orçamento</h6>
                            <!-- Billing details -->
                            <div class="row mb-5 gy-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="cic">CNPJ*</label>
                                    <input class="form-control" id="cic" type="text" v-model="client.CIC"
                                        @blur="getClientByCnpj($event)" placeholder="Informe o CNPJ"
                                        v-mask="'##.###.###/####-##'" masked="false" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">E-mail*</label>
                                    <input class="form-control" id="email" type="email" v-model="client.email"
                                        placeholder="Informe o E-mail" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="cliente">Nome do Responsável *</label>
                                    <input class="form-control" id="cliente" type="text" v-model="client.cliente"
                                        placeholder="Informe o Nome do Responsável" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="razao">Razão Social*</label>
                                    <input class="form-control" id="razao" type="text" v-model="client.razao"
                                        placeholder="Informe a Razão Social" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="cidade">Cidade *</label>
                                    <input class="form-control" id="cidade" type="text" v-model="client.cidade"
                                        placeholder="Informe a Cidade" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="telefone">Telefone para Contato*</label>
                                    <input class="form-control" id="telefone" type="text"
                                        placeholder="Informe o Telefone" v-model="client.telefone"
                                        v-mask="['(##) ####-####', '(##) #####-####']" masked="false" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="observation">Observação</label>
                                    <input class="form-control" id="observation" type="text"
                                        v-model="client.observation" placeholder="Faça uma observação" />
                                </div>
                            </div>
                            <!-- Heading -->
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-4 offset-lg-1 sticky-lg-top sticky-lg-top-header"
                        style="top: 114.406px">
                        <ul class="list-group mb-6">
                            <li v-for="product in cart" class="list-group-item p-3">
                                <div class="row g-2">
                                    <div class="col-3 col-md-2">
                                        <img v-if="product.images && product.images.Caminho !== ''" class="img-fluid"
                                            :src="product.images.Caminho" :alt="product.Produto">
                                        <img v-else class="img-fluid" src="/public/assets/img/front/logo.png"
                                            :alt="product.Produto">
                                    </div>
                                    <div class="col">
                                        <div class="fw-600">
                                            <a class="text-mode" href="#">{{ product.Produto }}</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-body">Cód: {{ product.Codigo }}</span>
                                        </div>
                                        <div class="d-flex align-items-center" style="margin-top: -1em;">
                                            <span class="text-body">Quantidade: {{ product.quantity }}</span>
                                            <button class="btn btn-link px-0 text-success ms-auto" type="button"
                                                @click="removeProduct(product.Cod)">
                                                <i class="bi-trash3 me-2"></i>
                                                <span>Remover</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="card bg-gray-100">
                            <div class="card-body py-0 px-4">
                                <ul class="list-group list-group-flush">
                                    <!-- <li class="list-group-item d-flex bg-transparent px-0 py-3"><span>Subtotal</span>
                                        <span class="ms-auto">$89.00</span>
                                    </li> -->

                                    <li class="list-group-item d-flex bg-transparent px-0 py-3 fs-lg fw-600">
                                        <span>Total Itens</span>
                                        <span class="ms-auto">{{ typeof (cart) === 'object' &&
                                            Object.values(cart).length
                                            > 0 ? sumQuantities() : 0 }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-success w-100" @click="saveBudget()"
                                :title="'Preencha os dados corretamente'"
                                :disabled="Object.values(cart).length == 0 || client.CIC == '' || client.email == ''">
                                Enviar Orçamento
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import MiniCart from "./modal/MiniCart.vue";
import AppMenu from "./Menu.vue";
import { onError } from '../utils';

export default {
    data: function () {
        return {
            onError: onError,
            cart: [],
            client: {

            },
            client_exists: false
        };
    },
    computed: {},
    components: {
        MiniCart,
        AppMenu,
    },
    methods: {
        loadProductsFromLocalStorage() {
            const storedData = localStorage.getItem("cart");
            if (storedData) {
                const parsedData = JSON.parse(storedData);
                this.cart = parsedData;
            } else {
                this.cart = {};
            }
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
        getClientByCnpj(event) {
            let cnpj = event.target.value;
            if (!cnpj) return false;
            axios
                .get("/client/get-by-cnpj", {
                    params: { cnpj: cnpj },
                })
                .then((response) => {
                    if (response.data.client.client) {
                        console.log(response.data.client)
                        this.client = response.data.client.client;
                        this.client_exists = true;
                    } else {
                        this.client_exists = false;
                    }
                })
                .catch((error) => {
                    console.error("Houve um problema com a requisição:", error);
                });
        },
        clearCart() {
            localStorage.clear();
            this.cart = {};
        },
        sumQuantities() {
            return this.cart.reduce((total, item) => total + item.quantity, 0) ?? 0;
        },

        saveBudget() {
            axios.post('/budget', {
                client: this.client,
                client_exists: this.client_exists,
                cart: this.cart
            })
                .then(response => {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    localStorage.clear();
                    setTimeout(() => {
                        this.$router.push('/');
                    }, 2500);
                })
                .catch(error => {

                    error = this.onError(error);
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: error.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    console.error('Houve um problema com a requisição:', error);
                });
        },

    },
    beforeMount() {
        this.loadProductsFromLocalStorage();
    },
};
</script>
