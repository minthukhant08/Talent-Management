<template>
  <v-app dark>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      color=secondary
    >
      <v-list >
        <v-list-item @click="goRoute('/profile/' + User.id)">
          <v-list-item-action class="mr-3">
            <v-avatar size="55"><img :src='User.image' alt="avatar"></v-avatar>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="User.name"></v-list-item-title>
            <v-list-item-subtitle v-text="User.type"></v-list-item-subtitle>
          </v-list-item-content>

        </v-list-item>
        <v-divider></v-divider>
        <v-list-item>
          <v-list-item-action>
            <v-switch v-model="noti"  color="accent"></v-switch>
          </v-list-item-action>
          <v-list-item-title>Enable Notification</v-list-item-title>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-switch v-model="darkmode" color="accent"></v-switch>
          </v-list-item-action>
          <v-list-item-title>Enable Dark Mode</v-list-item-title>
        </v-list-item>
        <v-divider></v-divider>
        <v-list-item @click="goRoute('/courses')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Courses</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/activities')">
          <v-list-item-action>
            <v-icon>local_activity</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Activity</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="User.type == 'student'" @click="goRoute('/results')">
          <v-list-item-action>
            <v-icon>assignment</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Results</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="User.type == 'teacher'" @click="goRoute('/giveresults')">
          <v-list-item-action>
            <v-icon>person</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Give Results</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="User.type == 'teacher'" @click="goRoute('/assignment')">
          <v-list-item-action>
            <v-icon>assignment</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Assignment</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>
        <v-list-item @click="logout">
          <v-btn block  class="pt-1 accent" >Logout</v-btn>
        </v-list-item>

      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
      color=primary
    >
      <template v-if="$vuetify.breakpoint.smAndDown">
        <v-app-bar-nav-icon @click.stop="login"><v-icon color=exception>menu</v-icon></v-app-bar-nav-icon>
      </template>

      <div class="text-center pl-2 pr-2" >
        <v-avatar @click="goRoute('/')">
          <img src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB" alt="avatar">
        </v-avatar>
      </div>

      <v-spacer></v-spacer>
      <v-toolbar-items>
        <template v-if="$vuetify.breakpoint.mdAndUp && User.id!=null">
          <v-btn color=exception text @click="goRoute('/courses')"><v-icon color="info">mdi-book</v-icon>&nbsp;Courses</v-btn>
          <v-btn color=exception text @click="goRoute('/activities')"><v-icon>mdi-ticket</v-icon>&nbsp;Activities</v-btn>
          <template v-if="User.type == 'teacher'">
            <v-btn color=exception text @click="goRoute('/giveresults')"><v-icon>mdi-ticket</v-icon>&nbsp;Results</v-btn>
            <v-btn color=exception text @click="goRoute('/assignment')"><v-icon>mdi-clipboard-text</v-icon>&nbsp;Assignments</v-btn>
          </template>
          <template v-if="User.type == 'student'">
            <v-btn color=exception text @click="goRoute('/results')"><v-icon>mdi-clipboard-text</v-icon>&nbsp;Results</v-btn>
          </template>
        </template>
      </v-toolbar-items>


      <template v-if="User.id!=null">
        <v-menu
          :close-on-content-click="false"
          :nudge-width="200"
          offset-y
        >
          <template icon v-slot:activator="{ on }" v-show="">
            <v-btn class="mr-1" v-on="on" text icon>
              <v-badge :overlap='true' color='red'>
                <template v-slot:badge>
                  <span  v-if='newNoti!=0'>
                    {{newNoti}}
                  </span>
                </template>
                <v-icon color=exception>mdi-bell</v-icon>
              </v-badge>
            </v-btn>
          </template>
          <app-noti></app-noti>
        </v-menu>
        <template v-if="$vuetify.breakpoint.mdAndUp">
          <v-menu
            :close-on-content-click="false"
            :nudge-width="200"
            :offset-y='true'
          >
            <template icon v-slot:activator="{ on }" v-show="">
              <v-btn class="ml-2" v-on="on" text icon>
                  <v-avatar size="35">
                    <img :src="User.image" alt="avatar">
                  </v-avatar>
              </v-btn>
            </template>
            <profile-pop-up></profile-pop-up>
          </v-menu>
        </template>
      </template>
      <template v-if="User.id==null">
        <v-btn text icon @click.stop="login">
            <v-icon color=exception>mdi-login</v-icon>
        </v-btn>
      </template>
    </v-app-bar>

    <v-content class="content-background">
      <v-fade-transition mode="out-in">
            <router-view></router-view>
      </v-fade-transition>
    </v-content>

    <v-footer dark>
      <span>&copy; 2019</span>
    </v-footer>
    <v-dialog v-model="loginDialog" max-width="320px">
        <v-card width="100%;" class="py-3">
          <v-card-text class="text-center">
            <!-- <v-avatar size="250"> -->
              <v-img
                class="mb-4 ma-5 mb-5 mt-5"
                contain
                height="150"
                src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB"
              ></v-img>
            <!-- </v-avatar> -->
            <h3 class="title font-weight-light">Welcome to Talent Program!</h3>
            <span class="caption grey--text">Thanks for signing up</span>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions class="pb-0 px-3 pt-4" >
            <v-btn color=info block class="mb-3" @click="facebooklogin">
                <v-icon>fa fa-facebook</v-icon>
                   &nbsp;&nbsp;Sign in with Facebook
            </v-btn>
          </v-card-actions>
          <v-card-actions class="pb-3 pt-0 px-3">
            <v-btn block color='#ffffff' @click="googleLogin">
                <v-icon color='#000000'>fa fa-google</v-icon>
                   <span class="black--text">
                     &nbsp;&nbsp;Sign in with Google
                   </span>
            </v-btn>
          </v-card-actions>
        </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import {bus} from './app';
import firebase from 'firebase';
import noti from './components/notification/notification.vue';
import commonmethods from './mixins/commonMethods';
import profile from './components/userprofile/profilepopup.vue'
export default {
  components:{
    'app-noti' : noti,
    'profile-pop-up' : profile,
  },
  mixins:[commonmethods],
    data(){
      return{
        drawer: null,
        dark:false,
        loginDialog:false,
        darkmode:false,
        noti:false
      }
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      },
      newNoti(){
        return this.$store.getters.getNewNotiCount;
      }
    },
    watch: {
      darkmode(value){
        this.$store.dispatch('setmode',value);
        this.$vuetify.theme.dark = value;
      },
      noti(value){
        if (value) {
          this.getNotiToken();
          this.$store.dispatch('setNotiSubscribe',value);
        }
      }
    },
    methods:{
      login(){
        var _this = this;
        firebase.auth().onAuthStateChanged((user)=>{
          if (user) {
            this.drawer = !this.drawer;
            console.log("logged");
          } else {
            this.loginDialog = true;
            console.log("not logged");
          }
        });
      },
    },
    created () {
      bus.$on('show_login',()=>{
        this.loginDialog = true;
      });

      bus.$on('close_login',()=>{
        this.loginDialog = false;
      });
      bus.$on('new_noti',()=>{
        this.getNotification();
      });
      this.getNotification();
      this.darkmode = this.$store.getters.getMode;
      this.noti = this.$store.getters.isNotiSubscribed;
  }
}
</script>
<style>
.gradient-box{
  box-shadow: 0 0 20px inset rgba(0, 0, 0, 0.2);
  background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 100px);
}

.content-background{
  background-image: url('/images/background.png');
  background-position: center center;
  background-repeat:  no-repeat;
  background-attachment: fixed;
  background-size:  cover;
}
</style>
