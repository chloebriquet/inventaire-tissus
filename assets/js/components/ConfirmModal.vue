<template>
    <div class="modal-card">
        <div class="modal-card-body">
            <div class="content has-text-centered">
                {{ modalMessage ? modalMessage : $t('modal.default.message') }}
            </div>
        </div>
        <footer class="modal-card-foot">
            <a @click="$emit('confirm')" :class="`card-footer-item ${confirmClass}`">
                {{ confirmMessage ? confirmMessage : $t('modal.default.confirm') }}
            </a>
            <a @click="$emit('close');" :class="`card-footer-item ${cancelClass}`">
                {{ cancelMessage ? cancelMessage : $t('modal.default.cancel') }}
            </a>
        </footer>
    </div>
</template>

<script>
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
    name: 'ConfirmModal',
    props: {
        displayModal: {
            type: Boolean,
            default: false
        },
        modalMessage: String,
        confirmMessage: String,
        confirmClass: {
            type: String,
            default: 'has-text-danger'
        },
        cancelMessage: String,
        cancelClass: {
            type: String,
            default: 'has-text-link'
        },
    },
});
</script>

<style scoped>

</style>