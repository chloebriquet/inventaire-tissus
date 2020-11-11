<template>
    <section class="section">
        <div class="columns is-centered">
            <form class="column is-half" @submit="saveFabric">
                <b-field
                    :label="$t('fabric.field.box')"
                    :message="form.box.error"
                    :type="{ 'is-danger': form.box.error }"
                >
                    <b-input
                        type="number"
                        v-model="form.box.field"
                        required
                    ></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.material')"
                    :message="form.box.error"
                    :type="{ 'is-danger': form.box.error }"
                >
                    <b-input v-model="form.material.field" required></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.pattern')"
                    :message="form.pattern.error"
                    :type="{ 'is-danger': form.pattern.error }"
                >
                    <b-input v-model="form.pattern.field" required></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.state')"
                    :message="form.state.error"
                    :type="{ 'is-danger': form.state.error }"
                >
                    <b-input v-model="form.state.field" required></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.thickness')"
                    :message="form.thickness.error"
                    :type="{ 'is-danger': form.thickness.error }"
                >
                    <b-input v-model="form.thickness.field" required></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.width')"
                    :message="form.width.error"
                    :type="{ 'is-danger': form.width.error }"
                >
                    <b-input type="number" v-model="form.width.field"></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.length')"
                    :message="form.length.error"
                    :type="{ 'is-danger': form.length.error }"
                >
                    <b-input
                        type="number"
                        v-model="form.length.field"
                    ></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.comment')"
                    :message="form.comment.error"
                    :type="{ 'is-danger': form.comment.error }"
                >
                    <b-input
                        type="textarea"
                        v-model="form.comment.field"
                        maxlength="255"
                    ></b-input>
                </b-field>
                <b-field
                    :label="$t('fabric.field.colors')"
                    :message="form.colors.error"
                    :type="{ 'is-danger': form.colors.error }"
                >
                    <div class="columns colors">
                        <div v-for="color in colors" class="column is-6">
                            <color-field
                                :color="color"
                                :key="color.id"
                                v-model="form.colors.field"
                                :native-value="color['@id']"
                            />
                        </div>
                    </div>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-dark"
                        :value="
                            null !== fabric
                                ? $t('fabric.edit.action')
                                : $t('fabric.add.action')
                        "
                    />
                    <b-button
                        tag="input"
                        native-type="button"
                        type="is-light"
                        :value="$t('common.cancel')"
                        @click="goBack"
                    />
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
import { defineComponent, PropType } from '@vue/composition-api';
import { AxiosResponse } from 'axios';
import { API } from '../utils/http-common';
import Notification from '../utils/notification/Notification';
import Color from '../models/Color';
import Fabric from '../models/Fabric';
import FormField from '../types/FormField';
import Violation from '../types/Violation';
import ColorField from './ColorField.vue';

export default defineComponent({
    name: 'FabricForm',
    props: {
        fabric: {
            type: Object as null | PropType<Fabric>,
            default: null
        }
    },
    components: {
        ColorField
    },
    data() {
        return {
            colors: [] as Color[],
            form: {
                box: new FormField(),
                material: new FormField(),
                pattern: new FormField(),
                state: new FormField(),
                thickness: new FormField(),
                width: new FormField(),
                length: new FormField(),
                comment: new FormField(),
                colors: new FormField()
            } as { [key: string]: FormField },
            notification: new Notification() as Notification
        };
    },
    created() {
        this.initForm();
    },
    watch: {
        fabric: function() {
            this.initForm();
        }
    },
    methods: {
        initForm(): void {
            this.resetForm();
            this.getColors()
                .then(() => {
                    this.isLoaded = true;

                    if (null !== this.fabric) {
                        this.form.box.field = this.fabric.box;
                        this.form.material.field = this.fabric.material;
                        this.form.pattern.field = this.fabric.pattern;
                        this.form.state.field = this.fabric.state;
                        this.form.thickness.field = this.fabric.thickness;
                        this.form.width.field = this.fabric.width;
                        this.form.length.field = this.fabric.length;
                        this.form.comment.field = this.fabric.comment;
                        this.form.colors.field = this.fabric.colors.map(
                            color => {
                                return color['@id'];
                            }
                        );
                    }
                })
                .catch(() => {
                    this.notification.error(
                        'common.notification.error.default'
                    );
                });
        },
        getColors(): Promise<void> {
            return new Promise<void>((resolve, reject) => {
                API.get('/colors')
                    .then(response => {
                        this.colors = response.data['hydra:member'];
                        this.form.colors.field = [];
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            });
        },
        goBack(): void {
            this.resetForm();
            this.$router.go(-1);
        },
        createFabric(formData: { [key: string]: string }): void {
            API.post('/fabrics', formData)
                .then((response: AxiosResponse<Fabric>) => {
                    this.notification.creationSuccess();
                    this.$emit('fabric-create', response.data.id);
                    this.$router.push({
                        name: 'fabric_see',
                        params: { fabricId: response.data.id.toString() }
                    });
                })
                .catch(error => {
                    this.displayErrors(error.response, () =>
                        this.notification.creationError()
                    );
                });
        },
        updateFabric(formData: { [key: string]: string }): void {
            API.put(`/fabrics/${this.fabric.id}`, formData)
                .then(response => {
                    this.notification.updateSuccess();
                    this.$emit('fabric-update', response.data.id);
                })
                .catch(error => {
                    this.displayErrors(error.response, () =>
                        this.notification.updateError()
                    );
                });
        },
        displayErrors(error: AxiosResponse, displayError: Function): void {
            if (400 === error.status) {
                const data = error.data;

                if ('violations' in data) {
                    data.violations.forEach((violation: Violation) => {
                        if (violation.propertyPath in this.form) {
                            this.form[violation.propertyPath].error +=
                                violation.message + ' ';
                        }
                    });
                }

                return;
            }

            displayError();
        },
        saveFabric(event: Event) {
            event.preventDefault();

            this.resetErrors();

            const formData: { [key: string]: any } = {
                box: Number(this.form.box.field),
                material: this.form.material.field,
                pattern: this.form.pattern.field,
                state: this.form.state.field,
                thickness: this.form.thickness.field,
                width: Number(this.form.width.field),
                length: Number(this.form.length.field),
                comment: this.form.comment.field,
                colors: this.form.colors.field
            };

            if (null === this.fabric) {
                this.createFabric(formData);

                return;
            }

            this.updateFabric(formData);
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
        }
    }
});
</script>

<style lang="scss" scoped>
.colors {
    flex-wrap: wrap;
    height: 10rem;
    overflow: auto;
}
</style>
