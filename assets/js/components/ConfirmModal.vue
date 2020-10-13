<template>
    <b-modal :active.sync="displayModal" @close="$emit('close')" has-modal-card aria-role="alertdialog" aria-modal>
        <div class="modal-card">
            <div class="modal-card-body">
                <div class="content has-text-centered">
                    {{ modalMessage }}
                </div>
            </div>
            <footer class="modal-card-foot">
                <a @click="$emit('confirm')" :class="`card-footer-item ${confirmClass}`">
                    {{ confirmMessage }}
                </a>
                <a @click="$emit('close');$emit('cancel');" :class="`card-footer-item ${cancelClass}`">
                    {{ cancelMessage }}
                </a>
            </footer>
        </div>
    </b-modal>
</template>

<script>
export default {
    name: 'ConfirmModal',
    props: {
        displayModal: {
            type: Boolean,
            default: false
        },
        modalMessage: {
            type: String,
            default: `Êtes-vous sûr·e d'effectuer cette action ?`
        },
        confirmMessage: {
            type: String,
            default: 'Confirmer'
        },
        confirmClass: {
            type: String,
            default: 'has-text-danger'
        },
        cancelMessage: {
            type: String,
            default: 'Annuler'
        },
        cancelClass: {
            type: String,
            default: 'has-text-link'
        }
    },
}
</script>

<style scoped>

</style>