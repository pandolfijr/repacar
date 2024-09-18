<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section class="section" style="margin-top: 8em;">
            <div class="container" style="background-color: white;">
                <div class="row">
                    <div class="col-lg-6 my-3 pe-lg-8">
                        <h3 class="mb-2 h2">Seja nosso Representante</h3>
                        <p class="fw-400">Preencha e envie o formulário, que nosso time de especialistas em vendas
                            entrará em contato com você!</p>

                    </div>
                    <div class="col-lg-6 my-3">
                        <div class="row g-3 pt-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="type" placeholder="Nome Completo*"
                                    v-model="email.name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="inputEmail4" placeholder="E-mail*"
                                    v-model="email.email">

                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="inputAddress" placeholder="Telefone"
                                    v-model="email.cellphone" v-mask="['(##) ####-####', '(##) #####-####']">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Mensagem" id="floatingTextarea2" rows="4"
                                    v-model="email.message">
                                </textarea>
                            </div>
                            <div v-if="!loading" class="col-12">
                                <button type="submit" class="btn btn-success" @click="sendEmail()"
                                    :disabled="email.name == '' || email.message == '' || email.cellphone == '' || email.email == ''">Enviar</button>
                            </div>

                            <div v-if="loading" class="col-12 text-center">
                                <div class="spinner"></div>
                                <p>Enviando e-mail, por favor aguarde...</p>
                            </div>
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
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';
import { onError } from '../utils';

export default {
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
    data: function () {
        return {
            cart: [],
            email: {
                email: '',
                name: '',
                cellphone: '',
                message: '',
                template: 'representative'
            },
            message: '',
            loading: false,
            successMessage: '',
            errorMessage: '',
            onError: onError,
        };
    },
    computed: {

    },
    components: {
        MiniCart,
        AppMenu,
    },
    methods: {
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
        sendEmail() {
            this.loading = true;  // Inicia a animação de carregamento
            this.successMessage = '';
            this.errorMessage = '';
            axios.post('/send-email', this.email)
                .then(response => {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    setTimeout(() => {
                        this.$router.push('/representative');
                    }, 2500);
                })
                .catch(error => {
                    this.loading = false;
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: error.response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    console.error('Houve um problema com a requisição:', error);
                });

        }

    },
    beforeMount() {
        this.loadProductsFromLocalStorage();
    },
};
</script>
