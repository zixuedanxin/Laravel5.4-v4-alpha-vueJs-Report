
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//window.VueRouter = require('vue-router');
import VueRouter from 'vue-router';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);
Vue.component('example', require('./components/Example.vue'));
Vue.component('card', require('./components/Card.vue'));
Vue.component('card-view', require('./components/CardsView.vue'));
Vue.component('add-card', require('./components/AddCard.vue'));

/* Router */
const Cards = require('./pages/cards/Index.vue');
const Card = require('./pages/cards/Show.vue');
const Home = require('./pages/home/Index.vue');
const routes = [
  { path: '/', name: 'index', component: Home },
  { path: '/cards', component: Cards },
  { path: '/cards/:id', component: Card , props: true },
  { path: '*', redirect: '/'}
];

// I don't know why it was not woking well, but with following code it is fine.
var path = window.location.pathname.replace('/ReportCards/public','');
var replacePlease = false;
for (var route of routes) {
  if (route.hasOwnProperty('path')) {
      if (route.path == path) {
        replacePlease = true;
        break;
      }
  }
}
if (replacePlease) {
    routes[routes.length-1] = { path: '*', redirect: path};
}

const router = new VueRouter({
  mode: 'history',
  base: __dirname + '/ReportCards/public',
  linkActiveClass: 'active',
  routes: routes
});

/* Vue */
const app = new Vue({
    data: {
      //currentRoute: window.location.pathname
    },
    router: router,
    el: '#app',
    created: function() {
      //console.log( window.location.pathname );
    }
});
