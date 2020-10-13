<template>
    <div>
        <div class="fabric-list columns is-mobile">
            <div v-for="fabric in fabrics" :key="fabric.id" class="column is-12-mobile is-6-tablet is-4-desktop">
                <fabric-list-element :fabric="fabric" @fabric-delete="confirmDelete(fabric)"/>
            </div>
        </div>
        <confirm-modal
            :displayModal="displayModal"
            @close="closeModal"
            @confirm="deleteFabric"
            @cancel="closeModal"
            :modal-message="`Êtes-vous sûr·e de supprimer le tissu &quot;${fabricToDelete.material}&quot; ?`"
            confirm-message="Oui, supprimer"
            cancel-message="Non, annuler" />
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {API} from '../http-common';
import Fabric from '../models/fabric';
import FabricListElement from './FabricListElement.vue';
import ConfirmModal from './ConfirmModal.vue';

export default defineComponent({
    name: 'FabricList',
    components: {
        ConfirmModal,
        FabricListElement,
    },
    data() {
        return {
            fabrics: [] as Fabric[],
            displayModal: false,
            fabricToDelete: {} as Fabric,
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
        confirmDelete(fabric: Fabric) {
            this.fabricToDelete = fabric;
            this.displayModal = true;
        },
        closeModal() {
            this.displayModal = false;
            this.fabricToDelete = {} as Fabric;
        },
        deleteFabric() {
            const id = this.fabricToDelete?.id;

            if (typeof id !== 'undefined') {
                API.delete(`/fabrics/${id}`);
            }

            const arrayId = this.fabrics.findIndex(value => {
                return this.fabricToDelete.id === value.id;
            });

            if (-1 !== arrayId) {
                this.fabrics.splice(arrayId, 1);
            }

            this.closeModal();
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
