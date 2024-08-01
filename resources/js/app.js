import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import VueTheMask from "vue-the-mask";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import money from "v-money3";

const Welcome = () => import("./components/Welcome.vue");
const About = () => import("./components/About.vue");
const BeRepresentative = () => import("./components/BeRepresentative.vue");
const Contact = () => import("./components/Contact.vue");
const Budget = () => import("./components/Budget.vue");
const Checkout = () => import("./components/Checkout.vue");
const Login = () => import("./components/Login.vue");
const QuickView = () => import("./components/modal/QuickView.vue");
const AppMenu = () => import("./components/Menu.vue");
const Product = () => import("./components/Product.vue");
const ProductDetail = () => import("./components/ProductDetail.vue");

// Cria uma instância do aplicativo Vue
const app = createApp({
    devtools: true,
});

//  ######################  INICIO ROTAS ######################


const routes = [
    { path: "/", name: "Welcome", component: Welcome },
    { path: "/about", name: "About", component: About },
    { path: "/representative", name: "BeRepresentative", component: BeRepresentative },
    { path: "/contact", name: "Contact", component: Contact },
    { path: "/budget", name: "Budget", component: Budget },
    { path: "/checkout", name: "Checkout", component: Checkout },
    { path: "/client-login", name: "Login", component: Login },
    { path: "/product", name: "Product", component: Product },
    { path: "/product-detail/:id", name: "ProductDetail", component: ProductDetail },
    { path: "/product/category/:category", name: "ProductCategory", component: Product },
    { path: "/product/category/:category/sub/:sub", name: "ProductCategorySub", component: Product },
    // {
    //     path: "/property_details/:id",
    //     name: "PropertyDetails",
    //     component: PropertyDetails,
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth'
            };
        }
        return { top: 0 };
    }
});

router.afterEach(() => {
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
});
app.component("quick-view", QuickView);
app.component("app-menu", AppMenu);

app.use(VueTheMask);
app.use(VueSweetalert2);
app.use(money);
//  ######################  FIM ROTAS ######################

app.use(router);

app.mount("#app");
