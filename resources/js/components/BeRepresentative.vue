<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section class="section" style="margin-top: 8em;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 my-3 pe-lg-8">
                        <h3 class="mb-2 h2">Seja nosso Representante</h3>
                        <p class="fw-400">Preencha e envie o formulário, que nosso time de especialistas em vendas
                            entrará em contato com você!</p>

                    </div>
                    <div class="col-lg-6 my-3">
                        <form class="row g-3 pt-3">
                            <div class="col-md-12"><input type="text" class="form-control" id="type"
                                    placeholder="Nome Completo*">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="inputEmail4" placeholder="E-mail*">

                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="inputAddress" placeholder="Telefone">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Mensagem" id="floatingTextarea2" rows="4">
                                </textarea>
                            </div>
                            <div class="col-12"><button type="submit" class="btn btn-success">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
</template>

<script>
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
        }

    },
    beforeMount() {
        this.loadProductsFromLocalStorage();
    },
};
</script>
