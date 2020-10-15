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
            type: Object as PropType<Fabric>,
            default: () => new Fabric(),
        },
    },
    data() {
        return {
            form: {
                box: new FormField(this.fabric.box),
                material: new FormField(this.fabric.material),
                pattern: new FormField(this.fabric.pattern),
                state: new FormField(this.fabric.state),
                thickness: new FormField(this.fabric.thickness),
                width: new FormField(this.fabric.width),
                length: new FormField(this.fabric.length),
                comment: new FormField(this.fabric.comment),
                colors: new FormField(this.fabric.colors),
                error: '' as string
            } as { [key: string]: any }
        }
    },
    methods: {
        saveFabric() {

        }
    }
})
</script>

<style lang="scss" scoped>

</style>
