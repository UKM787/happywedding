import './bootstrap'

import Vue from 'vue'


import PrimeVue from 'primevue/config';



import "primevue/resources/themes/saga-blue/theme.css"
import  "primevue/resources/primevue.min.css"
import "primeicons/primeicons.css"


import { createInertiaApp } from '@inertiajs/inertia-vue'

    Vue.component('landing-page', require('./components/Landing.vue').default);
    Vue.component('landing-manger-tools', require('./components/ManagerTools.vue').default);
    Vue.component('ideas-and-inspiration', require('./components/IdeasAndInspiration.vue').default);
    Vue.component('landing-footer', require('./components/Footer.vue').default);
    Vue.component('landing-header', require('./components/Header.vue').default);

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)
    Vue.use(PrimeVue)

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})