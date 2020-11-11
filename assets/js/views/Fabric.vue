<template>
    <router-view
        v-if="isLoaded"
        :fabrics="fabrics"
        :fabric="selectedFabric"
        @fabric-edit="goToFabricForm"
        @fabric-create="addFabric"
        @fabric-delete="removeFabric"
        @fabric-update="changeFabric"
    ></router-view>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api';
import { API } from '../utils/http-common';
import Fabric from '../models/Fabric';
import Notification from '../utils/notification/Notification';

export default defineComponent({
    name: 'Fabric',
    data() {
        return {
            displayModal: false,
            fabrics: [] as Fabric[],
            fabricToDelete: null as null | Fabric,
            isLoaded: true as boolean,
            notification: new Notification() as Notification,
            selectedFabric: null as null | Fabric
        };
    },
    mounted() {
        this.getFabrics();
        this.checkFabric();
    },
    watch: {
        '$route.params.fabricId': function() {
            this.checkFabric();
        }
    },
    methods: {
        addFabric(id: number): void {
            this.getFabric(id).then((fabric: Fabric) => {
                this.fabrics.push(fabric);
            });
        },
        changeFabric(id: number): void {
            this.getFabric(id).then((fabric: Fabric) => {
                const index = this.fabrics.findIndex((element: Fabric) => {
                    return element.id === fabric.id;
                });

                if (-1 !== index) {
                    this.fabrics.splice(index, 1, fabric);
                }
            });
        },
        checkFabric(): void {
            if (!this.isFabricSameAsSelected()) {
                this.isLoaded = false;
                this.getFabric(Number(this.$route.params.fabricId))
                    .then((fabric: Fabric) => {
                        this.selectedFabric = fabric;
                        this.isLoaded = true;
                    })
                    .catch(() => {
                        this.selectedFabric = {} as Fabric;
                    });
            }
        },
        getFabric(id: number): Promise<Fabric> {
            return new Promise<Fabric>((resolve, reject) => {
                API.get(`fabrics/${id}`)
                    .then(response => {
                        resolve(response.data);
                    })
                    .catch(() => {
                        this.notification.error('fabric.error.fetched');
                        reject();
                    });
            });
        },
        getFabrics: function(): void {
            this.isLoaded = false;
            API.get('fabrics').then(response => {
                this.fabrics = response.data['hydra:member'];
                this.isLoaded = true;
            });
        },
        goToFabricForm(fabric: Fabric): void {
            this.selectedFabric = fabric;
            this.$router.push({
                name: 'fabric_edit',
                params: { fabricId: fabric.id.toString() }
            });
        },
        isFabricSameAsSelected(): boolean {
            const hasRouteFabricId: boolean = 'fabricId' in this.$route.params;

            if (!hasRouteFabricId) {
                this.selectedFabric = null as null | Fabric;
                return true;
            }

            const fabricId: number = Number(this.$route.params.fabricId);

            return fabricId === this.selectedFabric?.id;
        },
        removeFabric(id: number): void {
            this.fabrics.splice(id, 1);
        }
    }
});
</script>

<style scoped></style>
