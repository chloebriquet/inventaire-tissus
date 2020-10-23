<template>
    <div class="card">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure v-for="color in fabric.colors" :style="`background-color: ${color.code}; width: ${colorWidth(fabric)}rem;`"></figure>
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
        <footer class="card-footer">
            <router-link :to="{name: 'fabric_see', params: { fabricId: fabric.id }}" class="card-footer-item">
                <span class="is-sr-only">{{ $t('fabric.see.action') }}</span><b-icon icon="eye" />
            </router-link>
            <a @click="$emit('fabric-edit', fabric)" class="card-footer-item">
                <span class="is-sr-only">{{ $t('fabric.edit.link') }}</span><b-icon icon="lead-pencil" />
            </a>
            <a @click="$emit('fabric-delete')" class="card-footer-item has-text-danger">
                <span class="is-sr-only">{{ $t('fabric.delete.action') }}</span><b-icon icon="delete-outline" />
            </a>
        </footer>
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {PropType} from '@vue/composition-api';
import Fabric from '../models/Fabric';

export default defineComponent({
    name: 'FabricListElement',
    props: {
        fabric: Object as PropType<Fabric>,
    },
    methods: {
        colorWidth(fabric: Fabric): number {
            return 3/fabric.colors.length;
        }
    }
})
</script>

<style lang="scss" scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.media-left {
    display: flex;
    flex-direction: row;
}
figure {
    height: 3rem;
}
</style>
