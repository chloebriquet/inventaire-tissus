<template>
    <b-checkbox v-model="checked" :native-value="nativeValue">{{ color.name }}</b-checkbox>
</template>

<script lang="ts">
import {defineComponent, PropType} from '@vue/composition-api';
import Color from '../models/Color';

export default defineComponent({
    name: 'ColorField',
    props: {
        color: {
            type: Object as null|PropType<Color>,
            default: null,
        },
        value: {
            type: Array as PropType<Array<String>>,
            default: [],
        },
        nativeValue: {
            type: String,
            default: '',
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
        },
    },
});
</script>

<style scoped>

</style>