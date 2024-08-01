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
                                <h3 class="h4 mb-0">Área do Cliente</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group mb-3">
                                    <label for="email_1" class="form-label">Email
                                        <span class="text-success">*</span>
                                    </label>
                                    <input type="text" id="email_1" class="form-control" placeholder="E-mail">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="form-label col" for="exampleInputPassword01">Senha
                                            <span class="text-success">*</span>
                                        </label>
                                    </div>
                                    <input type="password" class="form-control" id="exampleInputPassword01"
                                        placeholder="*********">
                                </div><!-- Checkbox -->

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success w-100" @click="login()">Log in</button>
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
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: 'Funcionalidade em Desenvolvimento!',
                showConfirmButton: false,
                timer: 2000
            });
        }
    },
    beforeMount() {
        this.loadProductsFromLocalStorage();
    },
};
</script>
