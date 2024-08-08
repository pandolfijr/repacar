<template>
    <Carousel :autoplay="5000" :wrap-around="true" style="margin-top: 8em;">
        <Slide v-for="slide in banners" :key="slide">
            <div class="carousel__item">
                <img :src="slide" alt="Banner Image" />
            </div>
        </Slide>

        <template #addons>
            <!-- <Pagination /> -->
        </template>
    </Carousel>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default defineComponent({
    name: 'Autoplay',
    components: {
        Carousel,
        Slide,
        Pagination,
    },
    data: function () {
        return {
            banners: [
                '/assets/img/front/bg-banner-1.png',
                '/assets/img/front/bg-banner-2.png',
                '/assets/img/front/bg-banner-3.png',
            ]

        };
    },
})
</script>

<style>
.carousel {
    width: 100%;
    max-width: 100%;
  }

  .carousel__item {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }

  .carousel__item img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }
</style>
