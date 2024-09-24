<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section class="section" style="margin-top: 8em;">
            <div class="container">
                <div class="justify-content-center row">
                    <div class="col-lg-5 col-xxl-4">
                        <div class="card">
                            <div class="card-header bg-transparent py-3">
                                <h3 class="h4 mb-0">Recuperar Senha</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="email_1" class="form-label">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="email_1" class="form-control" placeholder="E-mail"
                                        v-model="email">
                                </div>
                                <div v-if="login_process" class="row" style="margin-bottom: 1em;">
                                    <div class="col-sm-2 "></div>
                                    <div class="col-sm-3 ">
                                        <div class="spinner"></div>
                                    </div>
                                    <div class="col-sm-7">
                                        <label style="margin-top: 0.2em; margin-left: -2.5em">Preparando envio de e-mail</label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success w-100" @click="recovery()" :disabled="login_process">Enviar
                                        Link de
                                        Recuperação</button>
                                </div>
                                <div class="pt-4 text-center">
                                    <span class="text-muted">Já tem uma conta?
                                        <router-link :to="'/client-login'">Faça o login aqui.</router-link>
                                    </span>
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
import axios from 'axios';
import Swal from 'sweetalert2';
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';

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
            email: '',
            login_process: false,
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

        recovery() {
            this.login_process = true;
            if (this.email == '') {
                this.login_process = false;
                return Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: 'Preencha todos os campos',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            axios.post('/password/email', {
                email: this.email
            })
                .then(response => {
                    this.login_process = false;
                    if (response.status == 200) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: 'Email de Recuperação Enviado com Sucesso!!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            this.$router.push('/client-login');
                        }, 1500);
                    } else {
                        this.login_process = false;
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'Erro ao enviar email de recuperação',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: error.response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                })
                .finally(response => {
                    this.login_process = false;
                })
        },
        validateSession() {
            console.log('query', this.$route.query);
            if (this.$route.query.login) {
                this.$router.go('');
            }

            if (this.userData && this.userData.Cod && this.userData.Cod !== null) {
                this.$router.push('/orders');
            } else {
                this.$router.push('/client-login');
            }
        }
    },
    beforeMount() {
        // console.log('loginbefore',)
        // this.validateSession()
        // this.loadProductsFromLocalStorage();

    },
};
</script>

<style>
.spinner {
    border: 4px solid rgba(0, 0, 0, 0.1);
    width: 1.5em;
    height: 1.5em;
    border-radius: 50%;
    border-left-color: #079241;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
