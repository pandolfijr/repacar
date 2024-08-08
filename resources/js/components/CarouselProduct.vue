<template>
    <Carousel>
        {{ images }}
      <Slide v-for="(slide, index) in images" :key="slide">
        <img :src="slide.Caminho" alt="Banner Image" class="img-default-product" />
      </Slide>

      <!-- <Slide v-for="(slide, index) in images" :key="index" :class="{ 'active-slide': currentSlide === index }">
        <img :src="slide.Caminho" alt="Banner Image" class="img-default-product" />
    </Slide> -->

      <template #addons>
        <Navigation />
        <!-- <Pagination /> -->
      </template>
    </Carousel>
  </template>

  <script>
  import { defineComponent } from 'vue'
  import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

  import 'vue3-carousel/dist/carousel.css'

  export default defineComponent({
    name: 'Basic',
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
    },
    props: {
        images: {}
    }
  })
  </script>

  <style>
  .carousel__item {
    min-height: 200px;
    width: 100%;
    background-color: var(--vc-clr-primary);
    color: var(--vc-clr-white);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .carousel__slide {
    padding: 10px;
  }

  .carousel__prev,
  .carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
  }

  .img-default-product {
    max-height: 29em;
    padding: 4em;
}
  </style>
