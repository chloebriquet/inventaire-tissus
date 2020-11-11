<template>
  <div class="modal-card">
    <div class="modal-card-body">
      <div class="content has-text-centered">
        {{ modalMessage ? modalMessage : $t('modal.default.message') }}
      </div>
    </div>
    <footer class="modal-card-foot">
      <a :class="`card-footer-item ${confirmClass}`" @click="$emit('confirm')">
        {{ confirmMessage ? confirmMessage : $t('modal.default.confirm') }}
      </a>
      <a :class="`card-footer-item ${cancelClass}`" @click="$emit('close')">
        {{ cancelMessage ? cancelMessage : $t('modal.default.cancel') }}
      </a>
    </footer>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api';

export default defineComponent({
  name: 'ConfirmModal',
  props: {
    displayModal: {
      type: Boolean,
      default: false,
    },
    modalMessage: {
      type: String,
      default: '',
    },
    confirmMessage: {
      type: String,
      default: '',
    },
    confirmClass: {
      type: String,
      default: 'has-text-danger',
    },
    cancelMessage: {
      type: String,
      default: '',
    },
    cancelClass: {
      type: String,
      default: 'has-text-link',
    },
  },
});
</script>

<style scoped></style>
