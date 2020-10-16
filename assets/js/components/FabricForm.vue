<template>
    <section class="section">
        <div class="columns is-centered">
            <form class="column is-half" @submit="saveFabric">
                <b-field :label="$t('fabric.field.box')">
                    <b-input type="number" v-model="form.box.field" required></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.material')">
                    <b-input v-model="form.material.field" required></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.pattern')">
                    <b-input v-model="form.pattern.field" required></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.state')">
                    <b-input v-model="form.state.field" required></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.thickness')">
                    <b-input v-model="form.thickness.field" required></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.width')">
                    <b-input type="number" v-model="form.width.field"></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.length')">
                    <b-input type="number" v-model="form.length.field"></b-input>
                </b-field>
                <b-field :label="$t('fabric.field.comment')">
                    <b-input type="textarea" v-model="form.comment.field" maxlength="255"></b-input>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-light"
                        :value="fabric.id ? $t('fabric.edit.action') : $t('fabric.add.action')"
                    />
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
import {defineComponent, PropType} from '@vue/composition-api';
import Fabric from '../models/fabric';
import FormField from '../types/formField';

export default defineComponent({
    name: 'FabricForm',
    props: {
        fabric: {
            type: Object as PropType<Fabric>|null,
            default: null,
        },
    },
    data() {
        return {
            form: {
                box: new FormField(),
                material: new FormField(),
                pattern: new FormField(),
                state: new FormField(),
                thickness: new FormField(),
                width: new FormField(),
                length: new FormField(),
                comment: new FormField(),
                colors: new FormField(),
            } as {[key: string]: FormField},
        }
    },
    created() {
        this.initForm();
    },
    watch: {
        fabric: function () {
            this.initForm();
        }
    },
    methods: {
        initForm(): void {
            this.resetForm();

            if (null !== this.fabric) {
                this.form.box.field = this.fabric.box;
                this.form.material.field = this.fabric.material;
                this.form.pattern.field = this.fabric.pattern;
                this.form.state.field = this.fabric.state;
                this.form.thickness.field = this.fabric.thickness;
                this.form.width.field = this.fabric.width;
                this.form.length.field = this.fabric.length;
                this.form.comment.field = this.fabric.comment;
                this.form.colors.field = this.fabric.colors;
            }
        },
        resetErrors(): void {
            this.form.box.resetError();
            this.form.material.resetError();
            this.form.pattern.resetError();
            this.form.state.resetError();
            this.form.thickness.resetError();
            this.form.width.resetError();
            this.form.length.resetError();
            this.form.comment.resetError();
            this.form.colors.resetError();
        },
        resetFields(): void {
            this.form.box.resetField();
            this.form.material.resetField();
            this.form.pattern.resetField();
            this.form.state.resetField();
            this.form.thickness.resetField();
            this.form.width.resetField();
            this.form.length.resetField();
            this.form.comment.resetField();
            this.form.colors.resetField();
        },
        resetForm(): void {
            this.resetErrors();
            this.resetFields();
        },
        saveFabric() {

        }
    }
})
</script>

<style lang="scss" scoped>

</style>
