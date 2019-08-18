import firebase from 'firebase';
import {bus} from '../app';
export default{
  methods:{
    goRoute(route){
      this.$router.push(route)
    },
    googleLogin(){
      var provider = new firebase.auth.GoogleAuthProvider();
      var _this = this;
      firebase.auth().signInWithPopup(provider).then(function(result) {
        var token = result.credential.accessToken;
        _this.$http.post('http://localhost:8000/api/v1/users', {
          name  : result.user.displayName,
          email : result.user.email,
          image : result.user.photoURL
        }).then((response)=>{
          console.log(response.body.data);
          _this.$store.dispatch('setUser',response.body.data.user);
          _this.$store.dispatch('toggle_Login',true);
          console.log(_this.$store.getters.getUser);
          bus.$emit('close_login');
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
    }
  }
}
