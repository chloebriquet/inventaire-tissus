<template>
    <router-view :fabrics="fabrics" @fabric-delete="removeFabric"></router-view>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {API} from '../http-common';
import Fabric from '../models/fabric';

export default defineComponent({
    name: 'Fabric',
    data() {
        return {
            fabrics: [] as Fabric[],
            displayModal: false,
            fabricToDelete: {} as Fabric,
        };
    },
    mounted() {
        this.getFabrics();
    },
    methods: {
        getFabrics: function (): void {
            API.get('fabrics')
                .then(response => {
                    this.fabrics = response.data['hydra:member'];
                });
        },
        removeFabric(id: number): void {
            this.fabrics.splice(id, 1);
        }
    }
});
</script>

<style scoped>

</style>