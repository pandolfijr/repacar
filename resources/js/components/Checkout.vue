<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>

        <section class="section" style="margin-top: 8em">
            <div class="container" style="background-color: white;">
                <div class="row align-items-start">
                    <div class="col-md-7">
                        <!-- Form -->
                        <form>
                            <!-- Heading -->
                            <h6 class="mb-4 h3">Detalhes do Orçamento</h6>
                            <!-- Billing details -->

                            <div class="row mb-5 gy-4">
                                <div class="col-12 col-md-12">
                                    <label class="form-label" for="cic">CNPJ*</label>
                                    <input class="form-control" id="cic" type="text" v-model="client.CIC"
                                        @blur="getClientByCnpj($event)" placeholder="Informe o CNPJ"
                                        v-mask="'##.###.###/####-##'" masked="false" />
                                </div>

                            </div>
                            <div v-if="find_client" class="row" style="margin-top: -1em;margin-bottom: 1em;">
                                <div class="col-sm-3 "></div>
                                <div class="col-sm-1 ">
                                    <div class="spinner"></div>
                                </div>
                                <div class="col-sm-8">
                                    <label style="">Buscando Informações da Empresa</label>
                                </div>
                            </div>
                            <div class="row mb-5 gy-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="cliente">Nome do Responsável *</label>
                                    <input class="form-control" id="cliente" type="text" v-model="client.cliente"
                                        placeholder="Informe o Nome do Responsável" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">E-mail*</label>
                                    <input class="form-control" id="email" type="email" v-model="client.email"
                                        placeholder="Informe o E-mail" />
                                </div>
                            </div>
                            <div class="row mb-5 gy-4">
                                <div class="col-12">
                                    <label class="form-label" for="razao">Razão Social*</label>
                                    <input class="form-control" id="razao" type="text" v-model="client.razao"
                                        placeholder="Informe a Razão Social" />
                                </div>
                            </div>
                            <div class="row mb-5 gy-4">
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
                            </div>

                            <div class="row mb-5 gy-4">
                                <div class="col-9">
                                    <label class="form-label" for="observation">Observação</label>
                                    <input class="form-control" id="observation" type="text"
                                        v-model="client.observation" placeholder="Faça uma observação" />
                                </div>
                                <div v-if="client.CIC && client.CIC.length >= 18 && client.user_exists === false"
                                    class="col-3">
                                    <div style="margin-top: 3em;">
                                        <input id="observation" type="checkbox" v-model="create_user"
                                            placeholder="Faça uma observação" @click="treatCreateUser()" />
                                        <label class="form-label" for="observation" style="margin-left: 1em;">Criar
                                            Usuário</label>
                                    </div>
                                </div>
                                <div v-else-if="client.user_exists === true" class="col-3">
                                    <div style="margin-top: 3em;">
                                        <input id="observation" type="checkbox" v-model="user_login"
                                            placeholder="Faça uma observação" @click="treatCreateUser()" />
                                        <label class="form-label" for="observation" style="margin-left: 1em;">Fazer
                                            Login</label>
                                    </div>
                                </div>
                            </div>
                            <div v-if="create_user" class="row mb-5 gy-4">
                                <div class="col-6">
                                    <label class="form-label" for="site_User">Usuário para Acesso*</label>
                                    <input class="form-control" id="site_User" type="text" v-model="client.site_User"
                                        placeholder="Digite um usuário" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="site_Senha">Digite uma Senha*</label>
                                    <input class="form-control" id="site_Senha" type="password"
                                        placeholder="Digite uma Senha" v-model="client.site_Senha" />
                                </div>
                            </div>
                            <div v-else-if="user_login" class="row mb-5 gy-4">
                                <div class="col-6">
                                    <label class="form-label" for="site_User">Usuário para Acesso*</label>
                                    <input class="form-control" id="site_User" type="text" v-model="client.site_User"
                                        :disabled="client.email == ''" placeholder="Digite um usuário" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="site_Senha">Informe sua Senha*</label>
                                    <input class="form-control" id="site_Senha" type="password"
                                        placeholder="Digite uma Senha" v-model="login_password" />
                                </div>
                            </div>
                            <!-- Heading -->
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-4 offset-lg-1 sticky-lg-top sticky-lg-top-header"
                        style="top: 114.406px">
                        <ul class="list-group mb-6">
                            <li v-for="product in cart" class="list-group-item p-3" style="background-color: white;">
                                <div class="row">
                                    <div class="col-4">
                                        <img v-if="product.images && product.images[0].Caminho !== ''"
                                            class="img-default-product" :src="product.images[0].Caminho"
                                            :alt="product.Produto">
                                        <img v-else class="img-default-product" src="/public/assets/img/front/logo.png"
                                            :alt="product.Produto">
                                    </div>
                                    <div class="col-8">
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
                            <div v-if="save_process" class="row" style="margin-bottom: 1em;">
                                <div class="col-sm-2 "></div>
                                <div class="col-sm-3 ">
                                    <div class="spinner"></div>
                                </div>
                                <div class="col-sm-7">
                                    <label style="margin-top: 0.2em; margin-left: -2.5em">Gerando Orçamento...</label>
                                </div>
                            </div>

                            <button v-if="client.user_exists === true && user_login === true" type="submit"
                                class="btn btn-success w-100" @click="saveBudget(true)"
                                :title="'Preencha os dados corretamente'"
                                :disabled="Object.values(cart).length == 0 || client.CIC == '' || client.email == '' || save_process || (user_login && client.site_User == '' || user_login && login_password == '')">
                                Enviar Orçamento e Fazer Login
                            </button>

                            <button v-else type="submit" class="btn btn-success w-100" @click="saveBudget(false)"
                                :title="'Preencha os dados corretamente'"
                                :disabled="Object.values(cart).length == 0 || client.CIC == '' || client.email == '' || save_process || (create_user && client.site_User == '' || client.site_Senha == '')">
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
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
    mounted() {
        console.log('Dados da sessão:', this.userData);
    },
    data: function () {
        return {
            onError: onError,
            cart: [],
            client: {

            },
            create_user: false,
            user_login: false,
            client_exists: false,
            save_process: false,
            find_client: false,
            login_password: '',
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
            this.find_client = true;
            let cnpj = event.target.value;
            if (!cnpj) return false;
            axios
                .get("/client/get-by-cnpj", {
                    params: { cnpj: cnpj },
                })
                .then((response) => {
                    if (response.data) {
                        this.client = response.data;
                        this.client_exists = true;
                    } else {
                        this.client_exists = false;
                    }
                    this.find_client = false;
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
        treatCreateUser() {
            console.log(this.create_user);
            console.log(this.client);

            if (this.create_user === false) {
                this.client.site_User = this.client.email;
            } else {
                delete (this.client.site_User);
            }
        },
        saveBudget(login) {
            this.save_process = true;
            if (this.user_login === true) {
                if (this.login_password == '') {
                    return Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: 'Informe a Senha',
                        showConfirmButton: false,
                        timer: 2500
                    });
                } else {
                    this.client.site_Senha = this.login_password;
                }
            }

            axios.post('/budget', {
                client: this.client,
                client_exists: this.client_exists,
                cart: this.cart,
                login: login
            })
                .then(response => {
                    console.log(response.data.login);
                    Swal.fire({
                        position: "top-end",
                        icon: response.data.login == true ? "success" : 'warning',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: response.data.login == true ? 2500 : 3500
                    });
                    localStorage.clear();
                    this.save_process = false;
                    if (response.data.login == false) {
                        setTimeout(() => {
                            this.$router.push('/');
                        }, 2500);
                    } else {
                        setTimeout(() => {
                            this.$router.push({ path: '/orders', query: { reload: true } });
                        }, 2500);
                    }

                })
                .catch(error => {
                    this.save_process = false;
                    // console.log(error)
                    // error = this.onError(error);
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: error.response.data.message,
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

<style>
.img-default-product {
    max-height: 9em;
    max-width: 8em;
}

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
