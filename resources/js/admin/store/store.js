import Vue from 'vue';
import Vuex from 'vuex';
import PersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({
  state:{
    Admin:{},
    App:{
      login:false,
      noti:[],
      mode:true,
      notisubscribe:false,
      newNoti:0
    }
 },
  getters:{
    getMode:state=>{
      return state.App.mode;
    },
    getNewNotiCount:state=>{
      return state.App.newNoti;
    },
    getAdmin:state=> {
      return state.Admin;
    },
    loginStatus:state=>{
      return state.App.login;
    },
    getNoti:state=>{
      return state.App.noti;
    },
    isNotiSubscribed:state=>{
      return state.App.notisubscribe;
    }
  },
  mutations:{
    changeMode:(state,mode)=>{
      state.App.mode=mode;
    },
    changeLogin: (state,value)=>{
      console.log("logged is setted to " + value);
      state.App.login=value;
    },
    changeAdmin:(state,admin)=>{
      state.Admin = admin;
    },
    changeNoti:function(state,noti){
      state.App.noti=noti;
    },
    changeNotiCount:function(state,count){
      state.App.newNoti=count;
    },
    changeNotiSubscribe:function(state,value){
      state.App.notisubscribe=value;
    }
  },
actions:{
  setmode:function(context,mode){
    context.commit('changeMode',mode);
  },
  toggle_Login:(context,value)=>{
      context.commit('changeLogin',value);
  },
  setAdmin:function(context, admin){
    context.commit('changeAdmin',admin);
  },
  toggle_Loading:function(context){
    context.commit('changeLoading');
  },
  setNoti:function(context,noti){
    context.commit('changeNoti',noti);
  },
  setNotiCount:function(context,count){
    context.commit('changeNotiCount',count);
  },
  setNotiSubscribe:function(context,value){
    context.commit('changeNotiSubscribe',value);
  }
},
plugins: [PersistedState()]
})
