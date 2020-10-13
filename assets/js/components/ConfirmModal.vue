<template>
    <b-modal v-model="displayModal">
        <div class="card">
            <div class="card-content">
                <div class="content has-text-centered">
                    {{ modalMessage }}
                </div>
            </div>
            <footer class="card-footer">
                <a @click="$emit('confirm')" :class="`card-footer-item ${confirmClass}`">
                    {{ confirmMessage }}
                </a>
                <a @click="" :class="`card-footer-item ${cancelClass}`">
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
    methods: {

    }
}
</script>

<style scoped>

</style>