<template>
    <div class="card">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure v-for="color in fabric.colors" class="image is-48x48" :style="`background-color: ${color.code}`"></figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">{{ fabric.material }}</p>
                    <p class="subtitle is-6">{{ fabric.pattern }}</p>
                </div>
            </div>

            <div class="content">
                {{ fabric.comment }}
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import Fabric from '../models/fabric';
import {PropType} from '@vue/composition-api';

export default defineComponent({
    name: 'FabricListElement',
    props: {
        fabric: Object as PropType<Fabric>,
    }
})
</script>

<style lang="scss" scoped>

</style>
