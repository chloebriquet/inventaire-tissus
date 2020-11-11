<template>
  <div class="card">
    <div class="card-content">
      <div class="media">
        <div class="media-left">
          <figure
            v-for="color in fabric.colors"
            :key="color.id"
            :style="
              `background-color: ${color.code};
              width: ${colorWidth(fabric)}rem;`
            "
          />
        </div>
        <div class="media-content">
          <p class="title is-4">
            {{ fabric.material }}
          </p>
          <p class="subtitle is-6">
            {{ fabric.pattern }}
          </p>
        </div>
      </div>

      <div class="content">
        {{ fabric.comment }}
      </div>
    </div>
    <footer class="card-footer">
      <router-link
        :to="{ name: 'fabric_see', params: { fabricId: fabric.id } }"
        class="card-footer-item"
      >
        <span class="is-sr-only">{{ $t('fabric.see.action') }}</span
        ><b-icon icon="eye" />
      </router-link>
      <a class="card-footer-item" @click="$emit('fabric-edit', fabric)">
        <span class="is-sr-only">{{ $t('fabric.edit.link') }}</span
        ><b-icon icon="lead-pencil" />
      </a>
      <a
        class="card-footer-item has-text-danger"
        @click="$emit('fabric-delete')"
      >
        <span class="is-sr-only">{{ $t('fabric.delete.action') }}</span
        ><b-icon icon="delete-outline" />
      </a>
    </footer>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from '@vue/composition-api';

import Fabric from '../models/Fabric';

export default defineComponent({
  name: 'FabricListElement',
  props: {
    fabric: {
      type: Object as PropType<Fabric>,
      required: true,
    },
  },
  methods: {
    colorWidth(fabric: Fabric): number {
      return 3 / fabric.colors.length;
    },
  },
});
</script>

<style lang="scss" scoped>
.card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.media-left {
  display: flex;
  flex-direction: row;
}
figure {
  height: 3rem;
}
</style>
