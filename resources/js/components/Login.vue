<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section class="section" style="margin-top: 8em;">
            <div class="container">
                <div class="justify-content-center row">
                    <div class="col-lg-5 col-xxl-4">
                        <div class="card" style="background-color: white;">
                            <div class="card-header bg-transparent py-3">
                                <h3 class="h4 mb-0">Área do Cliente</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group mb-3">
                                    <label for="site_User" class="form-label">Email
                                        <span class="text-success">*</span>
                                    </label>
                                    <input type="text" id="site_User" class="form-control" placeholder="E-mail"
                                        v-model="user.client.site_User">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="form-label col" for="senha_User">Senha
                                            <span class="text-success">*</span>
                                        </label>
                                    </div>
                                    <input type="password" class="form-control" id="senha_User"
                                        v-model="user.client.site_Senha" placeholder="*********">
                                </div><!-- Checkbox -->
                                <div v-if="login_process" class="row" style="margin-bottom: 1em;">
                                    <div class="col-sm-2 "></div>
                                    <div class="col-sm-3 ">
                                        <div class="spinner"></div>
                                    </div>
                                    <div class="col-sm-7">
                                        <label style="margin-top: 0.2em; margin-left: -2.5em">Acessando sua conta
                                            ...</label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success w-100" @click="login()" :disabled="login_process">Logar</button>
                                </div>
                                <div class="pt-4 text-center">
                                    <span class="text-muted">Esqueceu sua senha?
                                        <router-link :to="'/recovery'">Clique aqui para recuperar.</router-link>
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
            user: {
                client: {
                    site_Senha: '',
                    site_User: '',
                }
            },
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
        login() {
            this.login_process = true;
            if (this.user.client.site_Senha == '' || this.user.site_User == '') {
                this.login_process = false;
                return Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: 'Preencha todos os campos',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            axios.post('/login', this.user)
                .then(response => {
                    if (response.data.login == true) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: 'Login realizado com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            this.$router.go();
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'Erro ao realizar login',
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
        console.log('loginbefore',)
        this.validateSession()
        this.loadProductsFromLocalStorage();

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
