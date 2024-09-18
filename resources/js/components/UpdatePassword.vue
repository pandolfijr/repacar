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
                                <h3 class="h4 mb-0">Redefinir sua Senha</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="form-label col" for="senha_User">Digite sua Senha
                                            <span class="text-success">*</span>
                                        </label>
                                    </div>
                                    <input type="password" class="form-control" id="senha_User"
                                        v-model="password" placeholder="*********">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="form-label col" for="senha_User">Digite sua Senha Novamente
                                            <span class="text-success">*</span>
                                        </label>
                                    </div>
                                    <input type="password" class="form-control" id="senha_User"
                                        v-model="password_confirmation" placeholder="*********">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success w-100" @click="test()">Alterar Senha</button>
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
            password: '',
            password_confirmation: '',
            token:'',
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

        test() {
            if (this.password !== this.password_confirmation) {
                return Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: 'As senhas não coincidem',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            axios.post('/update-password', {
                password: this.password,
                token: this.token
            })
                .then(response => {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            this.$router.push('/client-login');
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'Erro ao alterar a senha',
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
        this.token = this.$route.query.token;
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
