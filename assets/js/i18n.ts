import Vue from 'vue';
import VueI18n from 'vue-i18n';
import fr from './translations/fr.json';

Vue.use(VueI18n);

const translations = {
    "fr": fr
};

export default new VueI18n({
    locale: 'fr',
    fallbackLocale: 'fr',
    messages: translations
});
