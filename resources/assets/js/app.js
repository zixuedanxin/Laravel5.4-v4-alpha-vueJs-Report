
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

// Components
Vue.component('card', require('./components/Card.vue'));
Vue.component('card-view', require('./components/CardsView.vue'));
Vue.component('add-card', require('./components/AddCard.vue'));
Vue.component('card-table-view', require('./components/CardTableView.vue'));
Vue.component('card-chart-view', require('./components/CardChart.vue'));

// Charts
Vue.component('card-bar-chart', require('./components/charts/Bar.vue'));
Vue.component('card-liner-chart', require('./components/charts/Liner.vue'));

// Pages
Vue.component('card-show', require('./pages/cards/Show.vue'));

/* Router */
const Home = require('./pages/home/Index.vue');
const Cards = require('./pages/cards/Index.vue');
const routes = [
  { path: '/', name: 'index', component: Home },
  { path: '/cards', name:'cardsList', component: Cards },
  { path: '/cards/:id'},
  { path: '*', redirect: '/'}
];

// I don't know why it was not woking well, but with following code it is fine.
var path = window.location.pathname;
for (var route of routes) {
  if (route.hasOwnProperty('path')) {
      if (path.match(route.path)) {
        routes.splice(-1,1);
        routes.push({ path: '*', redirect: path});
        break;
      }
  }
}

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  linkActiveClass: 'active',
  routes: routes
});

/* Vue */
const app = new Vue({
    router: router,
    el: '#app',
    methods: {
      navigateToCardslist: function(force){
        if (force) {
          location.replace('/cards');
        }else{
          router.push('/cards');
        }
      }
    }
});
