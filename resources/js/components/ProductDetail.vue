<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>

        <div class="py-13-custom bg-gray-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-2">
                        <h1 class="m-0 h4 text-center text-lg-start">Detalhes do Produto</h1>
                    </div>
                    <div class="col-lg-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="#">
                                    <i class="bi bi-home"></i>Repacar / Produtos</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="product-details py-6" style="margin-top: 2em;">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-lg-6 lightbox-gallery product-gallery sticky-lg-top">
                        <CarouselProduct :images="product.images"></CarouselProduct>
                        <!-- <div class="swiper swiper_gallery">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="pd-gallery-slide">

                                        <div v-for="image in product.images">
                                            <div v-if="image.Imagem == 'Principal'">
                                                <a class="gallery-link" :href="image.Caminho">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </a>
                                                <img class="img-fluid" :src="image.Caminho" style=""
                                                    :alt="product.Produto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper swiper_thumb_gallery product-thumb">
                            <div class="swiper-wrapper">
                                <div v-for="image in product.images">

                                        <div class="swiper-slide">
                                            <div class="pd-gallery-slide-thumb">
                                                <img :src="image.Caminho" class="img-fluid" title=""
                                                    alt="">
                                            </div>
                                        </div>

                                </div>

                            </div>
                            <div class="swiper-arrow-style-03 swiper-next swiper-next-pd-details_thumb">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                            <div class="swiper-arrow-style-03 swiper-prev swiper-prev-pd-details_thumb">
                                <i class="bi bi-chevron-left"></i>
                            </div>
                        </div> -->
                    </div><!-- End Product Gallery --><!-- Product Details -->
                    <div class="col-lg-6 ps-lg-5 pt-5 pt-lg-0">
                        <div class="product-detail">
                            <!-- <div class="products-brand pb-2">
                                <span>Marca</span>
                            </div> -->
                            <div class="products-title mb-2">
                                <h4 class="h4">{{ product.Produto }}</h4>
                            </div>

                            <div class="product-description">
                                <p>
                                    {{ product.details ? product.details.Descritivo : '' }}
                                </p>
                            </div>
                            <div class="products-brand pb-2">
                                <span>Unidade: {{ product.unidade }}</span>
                            </div>

                            <div class="product-detail-actions d-flex flex-wrap pt-3">
                                <div class="product-card-info space-right">
                                    <span class="space-right" style=""> Qtd. {{ product.quantity ?
                                        product.quantity : '0' }}</span>
                                    <button @click="incrementQuantity(product)"
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        style="">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                    <button @click="decrementQuantity(product)"
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        :disabled="product.quantity <= 1 || !product.quantity">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <button
                                        class="btn btn-outline-secondary btn-sm custom-btn rounded-circle padding-button"
                                        @click="removeProduct(product.Cod)">
                                        <i class="bi bi-trash custom-icon"></i>
                                    </button>
                                </div>
                                <div class="product-cart-btn">
                                    <button @click="addToCart(product, product.quantity ?? 0)"
                                        class="btn btn-success btn-sm w-100">
                                        <i class="fi-shopping-cart"></i> Adicionar ao Carrinho
                                    </button>
                                </div>
                            </div>

                            <div class="pt-3 border-top mt-3 small">
                                <p class="theme-link mb-2"><label class="m-0 text-mode">Categoria:</label>
                                    {{ full_category.Categoria }} ({{ full_category.SubCategoria }})
                                </p>
                            </div>
                            <!-- <div class="pt-4">
                                <img class="img-fluid" src="../../assets/img/fashion/payment-details.png" title=""
                                    alt="">
                            </div> -->
                            <div class="product-detail-collapse">
                                <div class="pd-collapse-row"><a class="pd-collapse-h5" data-bs-toggle="collapse"
                                        href="#pd_description" role="button" aria-expanded="true"
                                        aria-controls="pd_description">Descrição do Produto <i
                                            class="bi bi-chevron-up"></i></a>
                                    <div class="collapse show" id="pd_description">
                                        <div class="pd-collapse-box">
                                            <p>{{ product.details ? product.details.Descricao : 'Descrição Genérica' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-collapse-row"><a class="pd-collapse-h5" data-bs-toggle="collapse"
                                        href="#pd_information" role="button" aria-expanded="false"
                                        aria-controls="pd_information">Informações <i class="bi bi-chevron-up"></i></a>
                                    <div class="collapse" id="pd_information">
                                        <div class="pd-collapse-box">
                                            <p>{{ product.details ? product.details.Descricao : 'Informação genérica' }}</p>
                                            <!-- <table class="table text-sm small m-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th class="fw-500 text-mode px-0">Color:</th>
                                                        <td class="text-muted">Blue, Purple, White</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-500 text-mode px-0">Size:</th>
                                                        <td class="text-muted">20, 24</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-500 text-mode px-0">Weight</th>
                                                        <td class="text-muted">Ut enim ad minim venialo quis nostrud
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-500 text-mode px-0">Material</th>
                                                        <td class="text-muted">100% Cotton.</td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                        </div>
                                    </div>
                                </div>

                            </div><!-- End More Details -->
                        </div>
                    </div><!-- End Product Details -->
                </div>
            </div>
        </section>

    </main>

</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import QuickView from './modal/QuickView.vue';
import MiniCart from './modal/MiniCart.vue';
import AppMenu from './Menu.vue';
import CarouselProduct from './CarouselProduct.vue';


export default {
    data: function () {
        return {
            product: {
                quantity: '',
            },
            cart: [],
            filter: '',
            selectedProduct: null,
            category: this.$route.params.category ? this.$route.params.category : '',
            sub: this.$route.params.sub ? this.$route.params.sub : '',
            category: {},
            full_category: {},
        };
    },
    computed: {

    },
    components: {
        QuickView,
        MiniCart,
        AppMenu,
        CarouselProduct
    },
    methods: {
        getProduct() {
            axios.get('/product/' + this.$route.params.id)
                .then(response => {
                    console.log(response)
                    this.product = response.data.product;
                    if (this.product) {
                        this.getCategory(this.product.CodSubCat)
                    }
                })
                .catch(error => {
                    console.error('Houve um problema com a requisição:', error);
                });
        },
        getCategory(subcat) {
            axios.get('/subcategory/' + subcat)
                .then(response => {
                    console.log('categ', response.data);
                    this.full_category = response.data.category.category;
                })
                .catch(error => {
                    console.error('Houve um problema com a requisição:', error);
                });
        },
        openQuickView(product) {
            this.selectedProduct = product;
            this.$nextTick(() => {
                $('#px-quick-view').modal('show');
            });
        },
        addToCart(product, quantity) {
            if (quantity === 0) {
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: 'Você não informou a quantidade',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
            const { Cod, Entrada, Codigo, Produto, NCM, Embalagem, Grupo, Peso, unidade, desativado, TipoPSO, origem, FabricacaoPropria, CodEFO, ProdPesavel, CodCat, CodSubCat, UnidadeTrib, images, stock } = product;
            const productToAdd = { Cod, Entrada, Codigo, Produto, NCM, Embalagem, Grupo, Peso, unidade, desativado, TipoPSO, origem, FabricacaoPropria, CodEFO, ProdPesavel, CodCat, CodSubCat, UnidadeTrib, images, quantity: quantity, stock };
            let products = JSON.parse(localStorage.getItem('cart')) || [];
            const existingProductIndex = products.findIndex(p => p.Cod === productToAdd.Cod);
            if (existingProductIndex !== -1) {
                products[existingProductIndex].quantity += productToAdd.quantity;
            } else {
                products.push(productToAdd);
            }
            localStorage.setItem('cart', JSON.stringify(products));
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: 'Produto adicionado ao carrinho',
                showConfirmButton: false,
                timer: 2000,
            });
            this.loadProductsFromLocalStorage();
            console.log(this.cart);
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
        incrementQuantity(product) {
            if (typeof product.quantity !== 'number' || isNaN(product.quantity)) {
                product.quantity = 0;
            }
            product.quantity++;
            this.loadProductsFromLocalStorage();
        },
        decrementQuantity(product) {
            if (product.quantity > 1) {
                product.quantity--;
            }
            this.loadProductsFromLocalStorage();
        },
        loadProductsFromLocalStorage() {
            const storedData = localStorage.getItem('cart');
            if (storedData) {
                const parsedData = JSON.parse(storedData);
                this.cart = parsedData;
            } else {
                this.cart = {};
            }
            console.log(this.cart);
        },
        clearCart() {
            localStorage.clear();
            this.cart = {};
        },
    },
    beforeMount() {
        this.getProduct();
        this.loadProductsFromLocalStorage();
    },
};
</script>

<style>
.select-container {
    position: relative;
}

.select-container i {
    position: absolute;
    top: 50%;
    right: 1em;
    transform: translateY(-50%);
    pointer-events: none;
    color: var(--bs-gray-700);
}

.login {
    border-color: #434a57;
    border-radius: 4em;
    padding: 0.1em 1.5em;
    height: 2em;
    font-size: 1em;
    margin-top: -1em;
}

.custom-btn {
    padding: 0.25em;
    width: 2em;
    height: 2em;
    align-items: center;
    justify-content: center;
    background-color: #079241;
    border: none;
    color: white;
}

.custom-btn:hover {
    background-color: #07642e;
}

.custom-btn:disabled {
    background-color: #07642e;
}

.custom-icon {
    font-size: 1.2em;
    color: white;
}

.padding-button {
    margin-left: 0.15rem !important;
}

.product-media {
    justify-content: center;
    align-items: center;
    padding: 1em;
    background-color: #fff;
    /* Cor de fundo branco para a borda */
    border-radius: 8px;
    /* Ajuste a borda como necessário */
}

.product-image {
    max-width: 100%;
    max-height: 200px;
    /* Defina a altura máxima desejada */
    object-fit: contain;
    /* Ajusta a imagem para caber dentro da div sem distorcer */
    border-radius: 8px;
    /* Ajuste a borda como necessário */
    background-color: #fff;
    /* Cor de fundo branco para a borda */
    padding: 1.5em;
}

.space-right {
    margin-right: 1em;
    margin-top: 0.5em;
}

.product-title-container {
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 6em;
    /* Define a altura fixa desejada */
    overflow-y: auto;
    /* Permite rolar o conteúdo excedente verticalmente */
}

.product-title {
    padding: 0 10px;
    /* Adicione padding para melhor espaçamento se necessário */

}

.product-title a {
    margin-top: -2.5em;
    display: block;
    /* Garante que o link ocupe toda a altura disponível */
    text-decoration: none;
    /* Remove a sublinha do link */
    color: inherit;
    /* Mantém a cor do texto */
}
</style>
