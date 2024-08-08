<template>
    <Carousel
        id="gallery"
        :items-to-show="1"
        :wrap-around="false"
        v-model="currentSlide"
    >
        <Slide v-for="(slide, index) in images" :key="index" :class="{ 'active-slide': currentSlide === index }">
            <img :src="slide.Caminho" alt="Banner Image" class="img-default-product" />
        </Slide>
    </Carousel>


    <Carousel v-if="Object.values(images).length > 1"
        id="thumbnails"
        :items-to-show="4"
        :wrap-around="true"
        v-model="currentSlide"
        ref="carousel"
    >
        <Slide v-for="(slide, index) in images" :key="index" class="detail-carousel" :class="{ 'active-thumbnail': currentSlide === index }">
            <img :src="slide.Caminho" alt="Banner Image" class="carousel__item" @click="slideTo(index)"   />
        </Slide>
    </Carousel>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default defineComponent({
    props: {
        images: {
            type: Array,
            required: true,
        },
    },
    name: 'Gallery',
    components: {
        Carousel,
        Slide,
    },
    data: () => ({
        currentSlide: 0,
    }),
    methods: {
        slideTo(index) {
            this.currentSlide = index;
        },
    },
})
</script>

<style scoped>
.detail-carousel {
    margin-right: 1em;
    border: 2px solid rgb(247, 247, 247);
}


#thumbnails .carousel__item img {
    height: 8px; /* Ajuste a altura conforme necessário */
    object-fit: cover; /* Garante que a imagem mantenha suas proporções */
}

.detail-carousel img {
    height: 10em; /* Ajuste a altura conforme necessário */
    object-fit: fill; /* Garante que a imagem mantenha suas proporções */
    margin-top: 0; /* Remove o ajuste negativo da margem */
    padding: 2em 0.5em 1em 0.5em;
}

.active-thumbnail {
    border: 2px solid rgb(207, 207, 207);
}

.img-default-product {
    max-height: 500em;
}
</style>
