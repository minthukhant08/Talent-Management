import Vue from 'vue';
import Vuex from 'vuex';
import PersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({
  state:{
    User:{name:null, email:null, image:null, type:null},
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
    getUser:state=> {
      return state.User;
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
    changeUser:(state,user)=>{
      state.User = user;
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
  setUser:function(context, user){
    context.commit('changeUser',user);
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
