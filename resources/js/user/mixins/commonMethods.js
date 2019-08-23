import firebase from 'firebase';
import {bus} from '../app';
export default{
  methods:{
    goRoute(route){
      this.$router.push(route);
    },
    googleLogin(){
      var provider = new firebase.auth.GoogleAuthProvider();
      var _this = this;
      firebase.auth().signInWithPopup(provider).then(function(result) {
        _this.$http.post('http://localhost:8000/api/v1/users', {
          name  : result.user.displayName,
          email : result.user.email,
          image : result.user.photoURL,
          auth_token :result.credential.accessToken
        }).then((response)=>{
          if(response.body.success){
            _this.$store.dispatch('setUser',response.body.data.user);
            _this.$store.dispatch('toggle_Login',true);
            console.log(_this.$store.getters.getUser);
            bus.$emit('close_login');
          }
        })
        .then((error)=>{
          console.log(error);
        })

      }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
        // ...
      });
    },
    facebooklogin(){
      console.log('logged');
      var provider = new firebase.auth.FacebookAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function(result) {
        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;
        console.log(token);
      }).catch(function(error) {
        // Handle Errors here.
        console.log(error);
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
        // ...
      });
  },
    checklogin(){
      var _this = this;
      firebase.auth().onAuthStateChanged((user)=>{
        if (user) {
          return true;
        } else {
          return false;
        }
      });
    },
    logout(){
      firebase.auth().signOut().then(()=>{
        this.$store.dispatch('setUser', {
          name  : '',
          email : '',
          image : ''
        });
        this.$store.dispatch('toggle_Login',false);
      })
    },
    getNotification(user_id){
      this.$http.get('http://localhost:8000/api/v1/notifications/6').then((response)=>{
        console.log(response.body);
        this.$store.dispatch('setNoti',response.body.data);
        this.$store.dispatch('setNotiCount',response.body.meta.total);
      })
    }
  }
}
