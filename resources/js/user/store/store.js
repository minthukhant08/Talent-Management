import Vue from 'vue';
import Vuex from 'vuex';
import PersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({
  state:{
    User:{},
    App:{
      login:false,
      noti:[],
      mode:false
    }
 },
  getters:{
    getmode:state=>{
      return state.App.mode;
    },
    getUser:state=> {
      return state.User;
    },
    loginStatus:state=>{
      return state.App.login;
    },
    getNoti:state=>{
      return state.App.noti;
    }
  },
  mutations:{
    mode:(state,mode)=>{
      state.App.mode=mode;
    },
    toggleLogin: (state,value)=>{
      console.log("logged is setted to " + value);
      state.App.login=value;
    },
    changeUser:(state,user)=>{
      state.User = user;
    },
    updateNoti:function(state,noti){
      state.App.noti=noti;
    }
  },
actions:{
  setmode:function(context,mode){
    context.commit('mode',mode);
  },
  toggle_Login:(context,value)=>{
      context.commit('toggleLogin',value);
  },
  setUser:function(context, user){
    context.commit('changeUser',user);
  },
  toggle_Loading:function(context){
    context.commit('changeLoading');
  },
  setNoti:function(context,noti){
    context.commit('updateNoti',noti);
  }
},
plugins: [PersistedState()]
})
