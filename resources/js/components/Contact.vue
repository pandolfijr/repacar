<template>

    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section class="section" style="margin-top: 5em; background-color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 my-3 pe-lg-8">
                        <div class="ratio ratio-16x9">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8034592883223!2d-47.811872624742996!3d-21.040548680611707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b993995f91ea3f%3A0x573994c77dcd2487!2sR.%20Empreiteiro%20Eraldo%20Silva%2C%2062%20-%20Jardin%C3%B3polis%2C%20SP%2C%2014680-000!5e0!3m2!1spt-BR!2sbr!4v1719774863492!5m2!1spt-BR!2sbr"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 my-3" >
                        <h3 class="mb-2 h2">Contato</h3>
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
        <div class="bg-gray-100 section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="text-primary display-5 mb-3"><i class="bi bi-telephone"></i></div>
                                <div class="">
                                    <p class="mb-0">(16) 3964-5901</p>
                                    <p>(16) 3636-3198</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="text-primary display-5 mb-3"><i class="bi bi-printer"></i></div>
                                <div class="">
                                    <p class="mb-0">+012 345 678 123</p>
                                    <p>+012 345 678 123</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="text-primary display-5 mb-3">
                                    <i class="bi bi-globe"></i>
                                </div>
                                <div class="">
                                    <p><a class="text-reset" href="#">contato@repacar.com.br</a></p>
                                    <p class="mb-0"><a class="text-reset" href="#"><br></a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="text-primary display-5 mb-3">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="">
                                    <p class="mb-0">Rua Empreiteiro Eraldo Silva, 62</p>
                                    <p>Distrito Industrial – Jardinópolis – SP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
