<template>
    <router-view v-if="isLoaded" :fabrics="fabrics" :fabric="selectedFabric" @fabric-edit="goToFabricForm" @fabric-delete="removeFabric"></router-view>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {API} from '../http-common';
import Fabric from '../models/fabric';

export default defineComponent({
    name: 'Fabric',
    data() {
        return {
            displayModal: false,
            fabrics: [] as Fabric[],
            fabricToDelete: {} as Fabric,
            isLoaded: true as boolean,
            selectedFabric: {} as Fabric,
        };
    },
    mounted() {
        this.getFabrics();
        this.checkFabric();
    },
    watch: {
        '$route.params.fabricId' : function () {
            this.checkFabric();
        },
    },
    methods: {
        checkFabric(): void {
            if (!this.isFabricSameAsSelected()) {
                this.getFabric(Number(this.$route.params.fabricId));
            }
        },
        getFabric(id: number): void {
            this.isLoaded = false;
            API.get(`fabrics/${id}`)
                .then(response => {
                    this.selectedFabric = response.data;
                    this.isLoaded = true;
                })
                .catch(() => {
                    this.selectedFabric = {} as Fabric;
                    this.$buefy.notification.open({
                        duration: 5000,
                        message: this.$t('fabric.error.fetched').toString(),
                        position: 'is-bottom',
                        type: 'is-danger'
                    });
                });
        },
        getFabrics: function (): void {
            this.isLoaded = false;
            API.get('fabrics')
                .then(response => {
                    this.fabrics = response.data['hydra:member'];
                    this.isLoaded = true;
                });
        },
        goToFabricForm(fabric: Fabric): void {
            this.selectedFabric = fabric;
            this.$router.push({ name: 'fabric_edit', params: { fabricId: fabric.id.toString() }});
        },
        isFabricSameAsSelected(): boolean {
            const hasRouteFabricId: boolean = 'fabricId' in this.$route.params;

            if (!hasRouteFabricId) {
                this.selectedFabric = {} as Fabric;
                return true;
            }

            const fabricId: number = Number(this.$route.params.fabricId);

            return fabricId === this.selectedFabric.id;
        },
        removeFabric(id: number): void {
            this.fabrics.splice(id, 1);
        }
    }
});
</script>

<style scoped>

</style>