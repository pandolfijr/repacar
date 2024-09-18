<template>
    <main>
        <MiniCart :cart="cart" @remove-product="removeProduct" @clear-cart="clearCart"></MiniCart>
        <AppMenu :cart="cart"></AppMenu>
        <Carousel></Carousel>

        <section class="section" style="margin-top: 8em;">
            <div class="container" style="background-color: white;">
                <div class="row" style="text-align: center; padding-top: 1em;" >
                    <h6 class="mb-3 text-gray-400">Nossa Missão</h6>
                    <h2 class="mb-4">Sobre a Repacar</h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 my-3">
                        <img src="/public/images/tubos.png" alt="" title="" class="">
                    </div>
                    <div class="col-lg-6 ps-lg-8 my-3" style="text-align: justify;">

                        <p>A REPACAR é sinônimo de seriedade, confiabilidade e competência no setor de reparos e materiais hidráulicos. Com anos de experiência e uma equipe altamente qualificada, nos orgulhamos em oferecer soluções de alta qualidade que atendem às necessidades de nossos clientes e superam suas expectativas.</p>

                        <p> Oferecemos uma ampla gama de produtos hidráulicos de excelência, desenvolvidos com tecnologia de ponta e materiais de alta durabilidade. Cada item do nosso catálogo é projetado para garantir maior eficiência e lucratividade aos nossos clientes, refletindo nosso profundo conhecimento em fabricação e nossa dedicação à qualidade.</p>

                        <p> Na REPACAR, estamos sempre em sintonia com as mais recentes tendências e inovações do mercado. Nosso compromisso com a melhoria contínua nos leva a constantemente otimizar nossos processos de produção e distribuição. Investimos em modernas infraestruturas, equipamentos de última geração e uma equipe de profissionais qualificados, garantindo assim a máxima eficiência e qualidade em cada etapa.</p>

                        <p>Acreditamos que um bom relacionamento com o cliente é fundamental para o sucesso. Por isso, utilizamos ferramentas de marketing avançadas, como folders informativos e um website intuitivo e completo, para facilitar a comunicação e fortalecer as parcerias profissionais. Nosso objetivo é oferecer um atendimento personalizado e atencioso, que faça cada cliente se sentir valorizado e bem atendido.</p>

                        <p>Nossa filosofia de trabalho é construída sobre uma base sólida de respeito e compromisso com nossos clientes. Estamos dedicados a oferecer um atendimento diferenciado, sempre com cortesia e prontidão, e a fornecer produtos de excelente qualidade que atendam às demandas mais exigentes. Na REPACAR, você encontra mais do que uma fornecedora de materiais hidráulicos: encontra um parceiro confiável para o seu sucesso.</p>
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
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
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
