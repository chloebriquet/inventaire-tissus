<template>
    <section class="section">
        <div class="fabric-list columns is-mobile">
            <div v-for="fabric in fabrics" :key="fabric.id" class="column is-12-mobile is-6-tablet is-4-widescreen">
                <fabric-list-element :fabric="fabric" @fabric-edit="goToFabricForm" @fabric-delete="confirmDelete(fabric)" />
            </div>
        </div>
        <b-modal
            v-model="displayModal"
            has-modal-card
            aria-role="alertdialog"
            aria-modal>
            <template #default="modal">
                <confirm-modal
                    @close="closeModal(modal)"
                    @confirm="deleteFabric(modal)"
                    :modal-message="$t('fabric.delete.confirm.message', {name: fabricToDelete.material})"
                    :confirm-message="$t('fabric.delete.confirm.yes')"
                    :cancel-message="$t('fabric.delete.confirm.no')"
                />
            </template>
        </b-modal>
    </section>
</template>

<script lang="ts">
import {defineComponent, PropType} from '@vue/composition-api';
import {API} from '../utils/http-common';
import Fabric from '../models/Fabric';
import FabricListElement from './FabricListElement.vue';
import ConfirmModal from './ConfirmModal.vue';

export default defineComponent({
    name: 'FabricList',
    components: {
        ConfirmModal,
        FabricListElement,
    },
    props: {
        fabrics: {
            type: Array as PropType<Fabric[]>,
            default: [],
        },
    },
    data() {
        return {
            displayModal: false,
            fabricToDelete: {} as Fabric,
        };
    },
    methods: {
        confirmDelete(fabric: Fabric): void {
            this.fabricToDelete = fabric;
            this.displayModal = true;
        },
        closeModal(modal: any): void {
            modal.close();
            this.fabricToDelete = {} as Fabric;
        },
        deleteFabric(modal: any): void {
            const id = this.fabricToDelete?.id;

            if (typeof id !== 'undefined') {
                API.delete(`/fabrics/${id}`);
            }

            const arrayId = this.fabrics.findIndex(value => {
                return this.fabricToDelete.id === value.id;
            });

            if (-1 !== arrayId) {
                this.$emit('fabric-delete', arrayId);
            }

            this.closeModal(modal);
        },
        goToFabricForm(fabric: Fabric) {
            this.$emit('fabric-edit', fabric);
        }
    }
});
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
