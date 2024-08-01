<template>
    <div class="wrapper"><!-- heder height -->
        <div class="header-height-bar"></div><!-- Header -->
        <header
            class="header-light navbar-expand-lg navbar-light fixed-top eader-main bg-mode-re header-height header-option-1">
            <div class="header-top small bg-info small">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Left -->
                        <div class="d-flex align-items-center justify-content-center d-none d-lg-block">
                            <ul class="nav white-link">
                                <li class="nav-item me-3 text-white text-opacity-85">
                                    <span>
                                        <i class="bi bi-clock me-2"></i> Horário de Atendimento: 9h00 às 18h00 </span>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="navbar-link">
                                        <i class="bi bi-headset me-2"></i> Fale Conosco: (16) 3964 5901 | (16) 3636 3198
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Right -->
                        <div class="d-flex align-items-center justify-content-center w-100 w-lg-auto">
                            <!-- Language -->
                            <ul class="nav ms-auto ms-lg-3">
                                <li class="nav-item">
                                    <router-link :to="'/client-login'" class="nav-link text-white">
                                        <i class="fi-user me-2"></i>Área do Cliente </router-link>
                                </li>
                            </ul>
                            <!-- Top social -->
                            <div class="nav header-social justify-content-end d-none d-lg-block white-link">
                                <a class="h-social-link"
                                    href="https://www.facebook.com/people/Repacar-Reparos/100054473799298/"
                                    target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a class="h-social-link" href="https://www.instagram.com/repacar_reparos/"
                                    target="_blank">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light fixed-top"
                style="background-color: white;margin-top:2.5em; margin-bottom: 3em;">
                <div class="container">
                    <!-- Logo -->
                    <a class="navbar-brand" href="/">
                        <img class="logo-dark" src="/public/assets/img/front/logo.png" title="" alt=""
                            style="width: 8em; height: 4em;">
                        <img class="logo-light" src="/public/assets/img/front/logo.png" title="" alt="">
                    </a>
                    <!-- Logo -->

                    <!-- Menu -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="dropdown dropdown-full nav-item">
                                <a href="#" class="nav-link">Produtos</a>
                                <label class="px-dropdown-toggle mob-menu"></label>
                                <div class="dropdown-menu dropdown-mega-menu py-0">
                                    <div class="container-fluid p-3 p-lg-4">
                                        <div class="row gy-4">
                                            <div class="col-6 col-md-4 col-lg-2" v-for="category in categories"
                                                :key="category.Codigo" style="margin-bottom: -0.5em;">
                                                <h6 class="sm-title-02 mb-3 fw-500">
                                                    <router-link :to="'/product/category/' + category.Codigo">{{
                                                        category.Categoria }}</router-link>
                                                </h6>
                                                <div
                                                    v-if="category.sub_category && Object.values(category.sub_category).length > 0">
                                                    <div class="sub-category-column"
                                                        v-for="(group, index) in chunkArray(category.sub_category, 10)"
                                                        :key="index">
                                                        <ul class="list-unstyled link-list-style-02">
                                                            <li v-for="sub in group" :key="sub.Codigo">
                                                                <a
                                                                    :href="'/product/category/' + category.Codigo + '/sub/' + sub.Codigo">{{
                                                                        sub.SubCategoria }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="dropdown-full nav-item">
                                <a href="https://www.repacar.com.br/downloads/110720241328021180965542.pdf"
                                    class="nav-link" target="_blank">Catálogo</a>
                            </li>
                            <li class="dropdown-full nav-item">
                                <router-link :to="'/budget'" class="nav-link">Orçamento</router-link>
                            </li>
                            <li class="dropdown-full nav-item">
                                <router-link :to="'/client-login'" class="nav-link">Área do Cliente</router-link>
                            </li>
                            <li class="dropdown-full nav-item">
                                <router-link :to="'/representative'" class="nav-link">Seja Um
                                    Representante</router-link>
                            </li>
                            <li class="dropdown-full nav-item">
                                <router-link :to="'/about'" class="nav-link">Repacar</router-link>
                            </li>
                            <li class="dropdown-full nav-item">
                                <router-link :to="'/contact'" class="nav-link">Contato</router-link>
                            </li>
                        </ul>
                    </div>
                    <!-- End Menu -->
                    <div class="nav flex-nowrap align-items-center header-right">
                        <div class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" id="dropdown_myaccount" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fi-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mt-2 shadow"
                                aria-labelledby="dropdown_myaccount">
                                <a class="dropdown-item" href="/client-login">Minha Conta</a>
                            </div>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" data-bs-toggle="offcanvas" href="#modalMiniCart" role="button"
                                aria-controls="modalMiniCart">
                                <span class="">
                                    <i class="fi-shopping-cart"></i>
                                </span>
                            </a>
                            <div v-if="cart && Object.values(cart).length > 0" class="cart-quantity">{{
                                Object.values(cart).length }}</div>
                        </div>
                        <!-- Mobile Toggle -->
                        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="px-navbar-toggler-icon"></span>
                        </button>
                        <!-- End Mobile Toggle -->
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
export default {
    props: {
        cart: {}
    },
    data: function () {
        return {
            categories: {},
            category: this.$route.params.category,
            sub: this.$route.params.sub,

        };
    },
    computed: {

    },
    components: {

    },
    methods: {
        chunkArray(array, size) {
            let results = [];
            for (let i = 0; i < array.length; i += size) {
                results.push(array.slice(i, i + size));
            }
            return results;
        },
        getCategories() {
            axios.get('/category')
                .then(response => {
                    this.categories = response.data.categories.categories;
                })
                .catch(error => {
                    console.error('Houve um problema com a requisição:', error);
                });
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
        initMegaMenu() {
            var mDropdown = $(".px-dropdown-toggle");
            mDropdown.on("click", function () {
                $(this).parent().toggleClass("open-menu-parent");
                $(this).next('.dropdown-menu').toggleClass("show");
                $(this).toggleClass("open");
            });
        }
    },
    mounted() {
        this.getCategories();
        this.initMegaMenu();
    },
    beforeMount() {
        // this.loadProductsFromLocalStorage();
    },
};
</script>

<style></style>
