<template>
    <div class="fabric-list columns is-mobile">
        <div v-for="fabric in fabrics" :key="fabric.id" class="column is-12-mobile is-6-tablet is-4-desktop">
            <fabric-list-element :fabric="fabric" @fabric-delete="deleteFabric(fabric)"/>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {API} from '../http-common';
import Fabric from '../models/fabric';
import FabricListElement from './FabricListElement.vue';

export default defineComponent({
    name: 'FabricList',
    components: {
        FabricListElement,
    },
    data() {
        return {
            fabrics: [] as Fabric[],
        }
    },
    mounted() {
        this.getFabrics();
    },
    methods: {
        getFabrics: function () {
            API.get('fabrics')
                .then(response => {
                    this.fabrics = response.data['hydra:member'];
                });
        },
        deleteFabric(fabric: Fabric) {
            const id = this.fabrics.findIndex(value => {
                return fabric.id === value.id;
            });

            if (-1 !== id) {
                this.fabrics.splice(id, 1);
            }
        }
    }
})
</script>

<style lang="scss" scoped>
.fabric-list {
    flex-flow: row wrap;
    justify-content: center;
    align-items: stretch;
    margin: 0;

    .card {
        width: 100%;
        height: 100%;
    }
}
</style>
