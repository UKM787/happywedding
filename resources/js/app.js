/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
//import Vue from 'vue';
//import Vue from 'vue'

window.Vue = require('vue').default;
import router from "./router"

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import { ValidationObserver, ValidationProvider} from 'vee-validate';
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

import './validation.js'

if(typeof route !== 'undefined'){
Vue.prototype.route = route;
}
Vue.prototype.moment =  require('moment');
// moment().format();
Vue.use(require('vue-moment'));

//import VueSplide from '@splidejs/vue-splide';
//import '@splidejs/splide/dist/css/themes/splide-default.min.css';

//Vue.use(VueSplide);
//Vue.prototype.$vm = window.vm;

/* following codes it used to import ziggy and use route() in vue */

//import route from 'ziggy';
//import { Ziggy } from './ziggy';

//console.log(route);

// window.route = route;
// window.Ziggy = Ziggy;

//Vue.use(ZiggyVue, Ziggy);
//route('home', undefined, undefined, Ziggy);

//Vue.use(Ziggy);
// Vue.mixin({
//     methods: {
//         route: (name, params, absolute) => route(name, params, absolute, Ziggy),
//     }
// });


window.event = new Vue();
window.flash = function (message) {
    window.event.$emit('flash', message);
};




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// importing primevue and its css
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/saga-blue/theme.css';  //theme
import 'primevue/resources/primevue.min.css';                 //core css
import 'primeicons/primeicons.css';
  
Vue.use(PrimeVue);  

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
  load: {
    key: "",
    libraries: "places" // necessary for places input
  }
});

import vClickOutside from 'v-click-outside';

 
Vue.use(vClickOutside)

import JwPagination from 'jw-vue-pagination';
import { isSet } from 'lodash';
import Vue from 'vue';
Vue.component('jw-pagination', JwPagination);

// Vue.component(
//   'landing-page',
//   // A dynamic import returns a Promise.
//   () => import('./components/Landing.vue')
// )

// Testing Components
Vue.component('test-page', () => import('./components/Test.vue'));

// Auth Components
Vue.component('login-page', () => import('./components/auth/Login.vue'));
// Vue.component('login-vendor-page', () => import('./components/auth/LoginVendor.vue'));
// Vue.component('login-guest-page', () => import('./components/auth/LoginGuest.vue'));
Vue.component('register-page', () => import('./components/auth/Register.vue'));
Vue.component('verify-email', () => import('./components/auth/VerifyEmail.vue'));
Vue.component('reset-password', () => import('./components/auth/ResetPassword.vue'));
Vue.component('confirm-password', () => import('./components/auth/ConfirmPassword.vue'));


// Landing Page
Vue.component('landing-page', () => import('./components/Landing.vue'));
Vue.component('landing-footer', () => import('./components/Footer.vue'));
Vue.component('landing-header', () => import('./components/Header.vue'));
Vue.component('landing-manger-tools', () => import('./components/ManagerTools.vue'));
Vue.component('ideas-and-inspiration', () => import('./components/IdeasAndInspiration.vue'));


/* admin panel components */
Vue.component('location-list', () => import('./components/admin/LocationComponent.vue'));
Vue.component('venue-list', () => import('./components/admin/VenueComponent.vue'));
Vue.component('vendor-component', () => import('./components/admin/VendorComponent.vue'));
Vue.component('ceramony-list', () => import('./components/admin/CeramonyComponent.vue'));
Vue.component('task-cat', () => import('./components/admin/TaskComponent.vue'));


/* host components */
Vue.component('host-header', () => import('./components/host/Header.vue'));
Vue.component('host-subscribe', () => import('./components/host/Subscribe.vue'));
Vue.component('host-subscribed', () => import('./components/host/Subscribed.vue'));
Vue.component('host-reccuring-subscription', () => import('./components/host/ReccuringSubscription.vue'));
Vue.component('host-reccuring-subscribed', () => import('./components/host/ReccuringSubscribed.vue'));


Vue.component('invi-nav', () => import('./components/host/invitation/NavInvi.vue'));
Vue.component('host-nav', () => import('./components/host/hostNav.vue'));
Vue.component('host-home', () => import('./components/host/Home.vue'));

Vue.component('member-list', () => import('./components/host/MemberList.vue'));
Vue.component('task-list', () => import('./components/host/TaskList.vue'));
Vue.component('contact-form', () => import('./components/host/ContactForm.vue'));
Vue.component('category-component', () => import('./components/host/Category.vue'));
Vue.component('host-logistics', () => import('./components/host/Logistics.vue'));
Vue.component('host-gallery', () => import('./components/host/Gallery.vue'));

Vue.component('invitation-cover-new', () => import('./components/host/invitation/InvitationCover.vue'));
Vue.component('invitation-save-date', () => import('./components/host/invitation/InvitationSavedate.vue'));
Vue.component('invitation-our-story', () => import('./components/host/invitation/InvitationOurstory.vue'));
Vue.component('invitation-guest-list', () => import('./components/host/invitation/guests/GuestList.vue'));
Vue.component('invitation-ceremony-list', () => import('./components/host/invitation/ceremonies/Ceremony.vue'));
Vue.component('invitation-help-line', () => import('./components/host/invitation/helpline/HelpLine.vue'));


Vue.component('invitation-date-time', () => import('./components/host/invitation/DateTime.vue'));
Vue.component('host-profile', () => import('./components/host/Profile.vue'));
Vue.component('host-final-vendors', () => import('./components/host/FinalVendor.vue'));
Vue.component('host-reports', () => import('./components/host/Reports.vue'));




Vue.component('guest-invitation-banner-peach', () => import('./components/guest/invitationDesigns/invitationPeach/InvitationBanner.vue'));
Vue.component('guest-invitation-banner-gold', () => import('./components/guest/invitationDesigns/invitationGold/InvitationBanner.vue'));


/* guest components */
Vue.component('guest-profile', () => import('./components/guest/Profile.vue'));
Vue.component('guest-home', () => import('./components/guest/HomePage.vue'));
Vue.component('guest-invite-list', () => import('./components/guest/InviteList.vue'));
Vue.component('guest-invitation-banner', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationBanner.vue'));
Vue.component('guest-invitation-ceramony', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationCeramony.vue'));
Vue.component('guest-invitation-accommodation', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationAccommodation.vue'));
Vue.component('guest-invitation-logistics', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationLogistics.vue'));
Vue.component('guest-invitation-gallery', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationGallery.vue'));
Vue.component('guest-invitation-helpline', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationHelpline.vue'));
Vue.component('guest-invitation-story', () => import('./components/guest/invitationDesigns/invitationDefault/InvitationStory.vue'));
Vue.component('guest-ceremony-deafult-card', () => import('./components/guest/invitationDesigns/invitationDefault/ceremonyCards/CardDefault.vue'));








/* prototype componets */
Vue.component('example-component', () => import('./components/ExampleComponent.vue'));
Vue.component('articles', () => import('./components/Articles.vue'));
Vue.component('service-component', () => import('./components/Service.vue'));
Vue.component('product-component', () => import('./components/Product.vue'));
Vue.component('guest-component', () => import('./components/GuestComponent.vue'));
Vue.component('flash', () => import('./components/Flash.vue'));

Vue.component('flash-message', () => import('./components/FlashMessage.vue'));

/* bride components */
  Vue.component('bride-welcome', () => import('./components/bride/Welcome.vue'));
  Vue.component('bride-shortlisted', () => import('./components/bride/Shortlisted.vue'));
  Vue.component('bride-todolist', () => import('./components/bride/Todolist.vue'));
  Vue.component('bride-post', () => import('./components/bride/Post.vue'));
  Vue.component('bride-workdetails', () => import('./components/bride/Workdetails.vue'));
  Vue.component('bride-profile', () => import('./components/bride/Profile.vue'));

  /* groom components */
  Vue.component('groom-welcome', () => import('./components/groom/Welcome.vue'));
  Vue.component('groom-shortlisted', () => import('./components/groom/Shortlisted.vue'));
  Vue.component('groom-todolist', () => import('./components/groom/Todolist.vue'));
  Vue.component('groom-post', () => import('./components/groom/Post.vue'));
  Vue.component('groom-workdetails', () => import('./components/groom/Workdetails.vue'));
  Vue.component('groom-profile', () => import('./components/groom/Profile.vue'));

  /* wedding Planner components */
  Vue.component('weddingplanner-welcome', () => import('./components/weddingPlanner/Welcome.vue'));
  Vue.component('weddingplanner-landing', () => import('./components/weddingPlanner/Landing.vue'));
  Vue.component('weddingplanner-lead', () => import('./components/weddingPlanner/Leads.vue'));
  Vue.component('weddingplanner-project', () => import('./components/weddingPlanner/Projects.vue'));
  Vue.component('weddingplanner-calander', () => import('./components/weddingPlanner/Calander.vue'));
  Vue.component('weddingplanner-profile', () => import('./components/weddingPlanner/Profile.vue'));


/* vendor components */
   Vue.component('vendor-welcome', () => import('./components/vendor/Welcome.vue'));
   Vue.component('vendor-landing', () => import('./components/vendorDirectory/VendorDirectoryLanding.vue'));
   Vue.component('vendor-lead', () => import('./components/vendor/Leads.vue'));
   Vue.component('vendor-project', () => import('./components/vendor/Projects.vue'));
   Vue.component('vendor-calander', () => import('./components/vendor/Calander.vue'));


   //vendor check
    Vue.component('vendor-check-profile', () => import('./components/vendor/checkVendor/Profile.vue'));
    Vue.component('vendor-check-category', () => import('./components/vendor/checkVendor/Category.vue'));
    
    Vue.component('vendor-select-dashboard', () => import('./components/vendor/checkVendor/SelectDashboard.vue'));
    
    Vue.component('vendor-select-service-multiple', () => import('./components/vendor/checkVendor/SelectService.vue'));
    Vue.component('vendor-select-service', () => import('./components/vendor/services/Services.vue'));


    //guest calander
    Vue.component('guest-calander', () => import('./components/GuestCalander.vue'));


    // directory common components
    Vue.component('makeup-card', () => import('./components/vendorDirectory/commonComponents/makeupCard.vue'));
    Vue.component('search-header', () => import('./components/vendorDirectory/commonComponents/searchHeader.vue'));
    Vue.component('review', () => import('./components/vendorDirectory/commonComponents/Review.vue'));

    //Makeup Components
    Vue.component('wear-style-makeup', () => import('./components/vendorDirectory/wearStyleMakeup/Landing.vue'));
    Vue.component('wear-style-makeup-filtered', () => import('./components/vendorDirectory/wearStyleMakeup/Filtered.vue'));
    Vue.component('wear-style-makeup-single', () => import('./components/vendorDirectory/wearStyleMakeup/Single.vue'));
    //Wedding Venue Components
    Vue.component('landing-wedding-venue', () => import('./components/vendorDirectory/venues/WeddingVenues.vue'));
    Vue.component('landing-wedding-venue-filtered', () => import('./components/vendorDirectory/venues/WeddingVenuesFiltered.vue'))  ;
    Vue.component('landing-wedding-venue-single', () => import('./components/vendorDirectory/venues/WeddingVenuesSingle.vue'));





   //accomodation componenets
   Vue.component('vendor-accomodation-register', () => import('./components/vendor/services/vendorAccomodation/AccomodationRegister.vue'));
   Vue.component('vendor-accomodation-all', () => import('./components/vendor/services/vendorAccomodation/AccomodationAll.vue'));
   Vue.component('vendor-accomodation-filtered', () => import('./components/vendor/services/vendorAccomodation/AccomodationFiltered.vue'));
   Vue.component('vendor-accomodation-single', () => import('./components/vendor/services/vendorAccomodation/AccomodationSingle.vue'));


    //venue componenets
   Vue.component('vendor-venue-all', () => import('./components/vendor/services/vendorVenue/VenueAll.vue'));
   Vue.component('vendor-venue-filtered', () => import('./components/vendor/services/vendorVenue/VenueFiltered.vue'));
   Vue.component('vendor-venue-single', () => import('./components/vendor/services/vendorVenue/VenueSingle.vue'));
   Vue.component('vendor-venue-register', () => import('./components/vendor/services/vendorVenue/VenueRegister.vue'));


   //Footer Links Components
   Vue.component('landing-terms-condition', () => import('./components/footerPages/TermsCondition.vue'));
   Vue.component('landing-privacy-policy', () => import('./components/footerPages/PrivacyPolicy.vue'));
   Vue.component('landing-about', () => import('./components/footerPages/About.vue'));
   Vue.component('landing-contact-us', () => import('./components/footerPages/ContactUs.vue'));
   Vue.component('landing-faq', () => import('./components/footerPages/FAQs.vue'));
   Vue.component('landing-careers', () => import('./components/footerPages/Careers.vue'));
   Vue.component('landing-sitemap', () => import('./components/footerPages/SiteMap.vue'));


        //Vue.component('spa-component', require('./components/Spa.vue').default);
        


   // Site Task components
    Vue.component('site-tasks-form', () => import('./components/siteTasks/taskForm.vue'));

    //Common Components
    Vue.component('vue-validation', () => import('./components/commonComponents/VueValidation.vue'));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
    router,
    data() {
        return {

        };
    },
    methods: {
        // Temporary workaround for handleVenueUpdate error
        handleVenueUpdate(data) {
            console.log('Root handleVenueUpdate called (this should not happen):', data);
        }
    },

});


// Vue.config.devtools = false
// Vue.config.debug = false
// Vue.config.silent = true

