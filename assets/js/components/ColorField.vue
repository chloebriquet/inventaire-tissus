<template>
    <div class="media">
        <figure
            class="media-left"
            :style="`background-color: ${color.code}`"
        ></figure>
        <div class="media-content">
            <b-checkbox v-model="checked" :native-value="nativeValue">{{
                color.name
            }}</b-checkbox>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from '@vue/composition-api';
import Color from '../models/Color';

export default defineComponent({
    name: 'ColorField',
    props: {
        color: {
            type: Object as null | PropType<Color>,
            default: null
        },
        value: {
            type: Array as PropType<Array<String>>,
            default: []
        },
        nativeValue: {
            type: String,
            default: ''
        }
    },
    computed: {
        checked: {
            get(): Array<String> {
                return this.value;
            },
            set(id: string): void {
                this.$emit('input', id);
            }
        }
    }
});
</script>

<style scoped>
.media {
    border-top: none;
    align-items: center;
}

figure {
    height: 2rem;
    width: 2rem;
}
</style>
