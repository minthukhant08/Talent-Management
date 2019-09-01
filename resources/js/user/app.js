require('../bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import '@mdi/font/css/materialdesignicons.css';
import SocialSharing  from 'vue-social-sharing';
import Routes from './routes';
import {store} from './store/store';
import firebaseConfig from './config/firebaseconfig.js';
import theme from './config/theme.js';
import * as firebase from 'firebase/app';
import 'firebase/auth';
import 'firebase/messaging';
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueResource);
Vue.use(SocialSharing);
Vue.component('app-view', require('./App.vue').default);
export const bus = new Vue();

const router= new VueRouter({
  routes:Routes,
  mode:'history'
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
      if (store.state.User.type == null) {
          next('/login')
      } else {
          next()
      }
  } else {
      next()
  }

  if (to.fullPath === '/results') {
    if (store.state.User.type != 'student') {
      next('');
    }
  }

  if (to.fullPath === '/giveresults') {
    console.log(store.state.Admin);
    if (store.state.User.type != 'teacher') {
      next('/');
    }
  }

  if (to.fullPath === '/assignment') {
    console.log(store.state.Admin);
    if (store.state.User.type != 'teacher') {
      next('/');
    }
  }

  if (to.fullPath === '/timetable') {
    console.log(store.state.Admin);
    if (store.state.User.type != 'teacher') {
      next('/');
    }
  }

  next();
});

const vuetify = new Vuetify(theme);

new Vue({
  store:store,
  vuetify : vuetify,
  el: '#app',
  router:router,
  data(){
    return{
      api:'http://localhost:8000/api/v1'
    }
  },
  created:function(){
    firebase.initializeApp(firebaseConfig);
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('../firebase-messaging-sw.js')
      .then(function(registration) {
          firebase.messaging().useServiceWorker(registration);
          console.log("Service Register Success");
      }).catch(function(err) {
        console.log('Service worker registration failed, error:', err);
      });
    }
    firebase.messaging().onMessage(function(payload) {
      bus.$emit('new_noti',payload);
    });
  }
});
