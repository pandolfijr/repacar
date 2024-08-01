<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>

        <section class="section" style="margin-top: 8em;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-3"><img src="/public/images/tubos.png" alt="" title="" class="img-fluid">
                    </div>
                    <div class="col-lg-6 ps-lg-8 my-3">
                        <h6 class="mb-3 text-gray-400">Nossa Missão</h6>
                        <h2 class="mb-4">Sobre a Repacar</h2>
                        <p>A REPACAR é uma empresa séria, confiável e competente, especializada em reparos e
                            materiais
                            hidráulicos.</p>

                        <p> Oferecemos produtos de alta qualidade que garantem maior lucratividade para nossos
                            clientes,
                            respaldados por nosso know-how em fabricação.</p>

                        <p> Estamos sempre atentos às novas tendências de mercado, visando otimizar nossos processos
                            de
                            produção e distribuição. Investimos em funcionários qualificados, infraestrutura
                            moderna,
                            equipamentos de produção avançados e ferramentas de marketing, como folders e websites,
                            para
                            melhorar nosso relacionamento com os clientes e fortalecer uma parceria profissional que
                            beneficia todos os envolvidos.</p>

                        <p>Nossa filosofia de trabalho é baseada no respeito aos clientes, oferecendo um atendimento
                            diferenciado e produtos de excelente qualidade.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="section bg-gray-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="pe-lg-5">
                            <h3 class="mb-3">Our vission</h3>
                            <p class="m-0">Flone provide how all this mistaken idea of denounc pleasure and sing pain
                                was born an
                                will give you a ete account of the system, and expound the actual teangs the eat
                                explorer of the
                                truth.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pe-lg-5">
                            <h3 class="mb-3">Our mission</h3>
                            <p class="m-0">Flone provide how all this mistaken idea of denounc pleasure and sing pain
                                was born an
                                will give you a ete account of the system, and expound the actual teangs the eat
                                explorer of the
                                truth.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pe-lg-5">
                            <h3 class="mb-3">Our goal</h3>
                            <p class="m-0">Flone provide how all this mistaken idea of denounc pleasure and sing pain
                                was born an
                                will give you a ete account of the system, and expound the actual teangs the eat
                                explorer of the
                                truth.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row justify-content-center section-heading">
                    <div class="col-lg-6 text-center">
                        <h3 class="h1">Team Members</h3>
                        <p class="m-0 fw-400">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor
                            incididunt labor et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card"><img class="img-fluid card-img-top" src="../../assets/img/pages/team-1.jpg"
                                alt="">
                            <div class="card-body">
                                <h4 class="h6 mb-1">Julianne Moore</h4>
                                <p class="mb-2">CEO &amp; Founder</p>
                                <div class="nav dark-link"><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-facebook"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-twitter"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-instagram"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-linkedin"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card"><img class="img-fluid card-img-top" src="../../assets/img/pages/team-2.jpg"
                                alt="">
                            <div class="card-body">
                                <h4 class="h6 mb-1">Julianne Moore</h4>
                                <p class="mb-2">CEO &amp; Founder</p>
                                <div class="nav dark-link"><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-facebook"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-twitter"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-instagram"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-linkedin"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card"><img class="img-fluid card-img-top" src="../../assets/img/pages/team-3.jpg"
                                alt="">
                            <div class="card-body">
                                <h4 class="h6 mb-1">Julianne Moore</h4>
                                <p class="mb-2">CEO &amp; Founder</p>
                                <div class="nav dark-link"><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-facebook"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-twitter"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-instagram"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-linkedin"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card"><img class="img-fluid card-img-top" src="../../assets/img/pages/team-4.jpg"
                                alt="">
                            <div class="card-body">
                                <h4 class="h6 mb-1">Julianne Moore</h4>
                                <p class="mb-2">CEO &amp; Founder</p>
                                <div class="nav dark-link"><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-facebook"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-twitter"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-instagram"></i> </a><a
                                        class="icon icon-sm bg-primary text-white rounded-circle me-2" href="#"><i
                                            class="bi bi-linkedin"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-gray-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-6">
                        <div class="text-center mb-30">
                            <div class="display-5 mb-3 text-primary"><i class="bi bi-briefcase"></i></div>
                            <h2 class="count">86</h2><span>project done</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="text-center mb-30">
                            <div class="display-5 mb-3 text-primary"><i class="bi bi-trophy"></i></div>
                            <h2 class="count">168</h2><span>cups of coffee</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="text-center mb-30">
                            <div class="display-5 mb-3 text-primary"><i class="bi bi-intersect"></i></div>
                            <h2 class="count">101</h2><span>branding</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="text-center mb-30 mrgn-none">
                            <div class="display-5 mb-3 text-primary"><i class="bi bi-emoji-smile"></i></div>
                            <h2 class="count">24</h2><span>happy clients</span>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
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
