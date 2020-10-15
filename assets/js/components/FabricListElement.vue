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
        <footer class="card-footer">
            <router-link :to="{ name: 'fabric_see', params: { fabricId: fabric.id }}" class="card-footer-item">
                <span class="is-sr-only">{{ $t('fabric.see.action') }}</span><b-icon icon="eye" />
            </router-link>
            <router-link :to="{ name: 'fabric_edit', params: { fabricId: fabric.id }}" class="card-footer-item">
                <span class="is-sr-only">{{ $t('fabric.edit.link') }}</span><b-icon icon="lead-pencil" />
            </router-link>
            <a @click="$emit('fabric-delete')" class="card-footer-item has-text-danger">
                <span class="is-sr-only">{{ $t('fabric.delete.action') }}</span><b-icon icon="delete-outline" />
            </a>
        </footer>
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {PropType} from '@vue/composition-api';
import Fabric from '../models/fabric';

export default defineComponent({
    name: 'FabricListElement',
    props: {
        fabric: Object as PropType<Fabric>,
    },
})
</script>

<style lang="scss" scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>
