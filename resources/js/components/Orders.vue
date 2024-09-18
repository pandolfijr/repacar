<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>
        <section v-if="userData && userData.Cod && userData.Cod != null" class="section" style="margin-top: 4em;">
            <main><!-- Breadcrumb -->
                <div class="py-3 bg-gray-100">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 my-2">
                                <h1 class="m-0 h4 text-center text-lg-start">Meus Pedidos</h1>
                            </div>
                        </div>
                    </div>
                </div><!-- End Breadcrumb --><!-- Table -->
                <div class="py-6">
                    <div class="container">
                        <div class="row"><!-- Profile Menu -->
                            <div class="col-lg-4 pb-4 pb-lg-0 col-xxl-3 pe-xxl-5">
                                <div class="bg-body border border-bottom-0 shadow-lg">
                                    <div class="d-flex p-6 align-items-center">
                                        <div class="col ">
                                            <div class="row">
                                                <h6 class="m-0">{{ userData.cliente }}</h6>
                                            </div>
                                            <div class="row" style="padding-top: 1em;">
                                                <b><a href="#">{{ userData.razao.toUpperCase() }}</a></b>
                                            </div>
                                            <div class="row">
                                                <small><a href="#">{{ userData.email }}</a></small><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 p-3 border-bottom border-top">
                                        <h6 class="m-0">Dashboard</h6>
                                    </div>
                                    <ul class="list-unstyled mb-0 theme-link">
                                        <li class="border-bottom mb-0"><a
                                                class="nav-link-style d-flex align-items-center active p-3" href="#"><i
                                                    class="bi bi-bag me-2"></i> Pedidos<div
                                                    class="ms-auto badge-pill badge bg-secondary">
                                                    {{ Object.values(budgets).length }}</div></a></li>
                                    </ul>
                                    <div class="bg-gray-200 p-3 border-bottom">
                                        <h6 class="m-0">Dados da Conta</h6>
                                    </div>
                                    <ul class="list-unstyled mb-0 theme-link">
                                        <!-- <li class="border-bottom mb-0"><a
                                                class="nav-link-style d-flex align-items-center p-3" href="#"><i
                                                    class="fi-user me-2"></i>Meus Dados</a>
                                        </li> -->

                                        <li class="border-bottom mb-0">
                                            <button @click="logout()"
                                                style="border-color: transparent; background-color: transparent;">
                                                <a class="nav-link-style d-flex align-items-center p-3">
                                                    <i class="bi bi-box-arrow-left me-2"></i>
                                                    Sair
                                                </a>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- End Profile Menu --><!-- Content -->
                            <div class="col-lg-8 col-xxl-9">
                                <div v-if="Object.values(budgets).length > 0" class="table-responsive fs-md mb-4">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead class="text-700 bg-gray-200">
                                            <tr>
                                                <th class="fw-600">Pedido #</th>
                                                <th class="fw-600">Data do Pedido</th>
                                                <th class="fw-600">Status</th>
                                                <th class="fw-600 text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="budget in budgets" :key="budget.Cod">

                                                <td class="p-3">
                                                    <a class="text-mode" href="#order-details" data-bs-toggle="modal">#
                                                        {{ budget.Pedido }}</a>
                                                </td>
                                                <td class="p-3">
                                                    {{ formattedDate(budget.Data) }}
                                                </td>
                                                <td class="p-3">
                                                    <span class="badge bg-info m-0">Realizado</span>
                                                </td>
                                                <td class="p-3 text-end">
                                                    {{ formatedValue(budget.Total) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-else class="text-center" style="margin-top: 1em;">
                                    <div class="d-none d-lg-block text-center">
                                        <h2>Nenhum Pedido Encontrado...</h2>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center mt-3">
                                    <div class="d-none d-lg-block">Showing: 1 - 12 of 17</div>
                                    <div class="ms-lg-auto">
                                        <ul class="pagination m-0">
                                            <li class="page-item"><a class="page-link" href="#"
                                                    aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                                        aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div><!-- End Content -->
                        </div>
                    </div>
                </div><!--Table -->
            </main><!-- End Main --><!-- Footer -->
        </section>
    </main>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';
import { formatDate } from '../utils';

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
            budgets: {},
            formatDate: formatDate,
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

        validateSession() {
            console.log(this.userData.Cod);
            if (this.userData && this.userData.Cod == null) {
                this.$router.push('/client-login');
            } else {
                this.getBudgets();
            }
        },
        logout() {
            axios.post('/logout', this.userData)
                .then(response => {
                    if (response.data.login == false) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: 'Você fez o logout...',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            this.$router.go('/');
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'Erro ao realizar logout',
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
                });
        },
        getBudgets() {
            axios.get('/budget', {
                params: this.userData,
            })
                .then(response => {
                    this.budgets = response.data.budgets;
                })
                .catch(error => {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: error.response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                });
        },
        formattedDate(date) {
            return this.formatDate(date.split(' ')[0]);
        },
        formatedValue(value) {
            return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }
    },
    created() {
        this.validateSession();
        this.loadProductsFromLocalStorage();


    },
};
</script>
