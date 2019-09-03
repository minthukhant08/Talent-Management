<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      color=secondary
    >

      <v-list >
        <v-list-item @click="goRoute('/admin/dashboard')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-group prepend-icon="person" >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>User</v-list-item-title>
            </v-list-item-content>
          </template>
          <v-list-item class="pl-9" @click="goRoute('/admin/student')">
            <v-list-item-action>
              <v-icon color="#455A64">person</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>Students</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="pl-9" @click="goRoute('/admin/teacher')">
            <v-list-item-action>
              <v-icon>person</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>Teachers</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="pl-9" @click="goRoute('/admin/scanner')">
            <v-list-item-action>
              <v-icon>person</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>Scanners</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        </v-list-group>
        <v-list-item @click="goRoute('/admin/course')">
          <v-list-item-action>
            <v-icon color="#43A047">mdi-book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Course</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/admin/batch')">
          <v-list-item-action>
            <v-icon color="#FF5722">mdi-account-group</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Batch</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/activity')">
          <v-list-item-action>
            <v-icon color="yellow">mdi-ticket</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Activity</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/topic')">
          <v-list-item-action>
            <v-icon color="blue">mdi-book-open-page-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Topic</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/topicdetail')">
          <v-list-item-action>
            <v-icon color="blue">mdi-book-open-page-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Topic Detail</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="Admin.role == 'Super Admin'" @click="goRoute('/admin/super')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Admins</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="Admin.role == 'Super Admin'" @click="goRoute('/admin/logs')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logs</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="logout">
          <v-list-item-action>
            <v-icon color="#303F9F">mdi-update</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
      color=primary
    >
      <v-app-bar-nav-icon @click.stop="login"><v-icon color=exception>menu</v-icon></v-app-bar-nav-icon>
      <div class="text-center pl-2 mt-2 pr-2" >
        <!-- <v-avatar> -->
          <img width="30" src="/images/logo.png" alt="logo">
        <!-- </v-avatar> -->
      </div>
      <!-- <v-toolbar-title class="pink--text" style="padding-top:25px;">Talent Program</v-toolbar-title> -->
      <v-spacer></v-spacer>
      <v-btn class="ml-2" v-if="Admin.image!=null" text icon>
          <v-avatar size="35">
            <img :src="Admin.image" alt="avatar">
          </v-avatar>
      </v-btn>
    </v-app-bar>

    <v-content>
      <v-fade-transition mode="out-in">
            <router-view></router-view>
      </v-fade-transition>
    </v-content>

    <v-footer dark>
      <v-spacer></v-spacer>
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
                src="/images/logo.png"
              ></v-img>
            <!-- </v-avatar> -->
            <h3 class="title font-weight-light">Welcome to Talent Program!</h3>
            <span class="caption grey--text">Login with Admin Account</span>
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
export default {
  components:{
    'app-noti' : noti,
  },
  mixins:[commonmethods],
    data(){
      return{
        drawer: null,
        dark:false,
        loginDialog:false
      }
    },
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      },
      showBadge(){
        var count;
        try {
          count = this.$store.getters.getNoti.length;
        } catch (e) {
          return 0;
        } finally {

        }
        return count;
      }
    },
    methods:{
      changemode(){
        this.$vuetify.theme.dark = this.dark;
      },
      login(){
        if (this.Admin.name != null) {
           this.drawer = !this.drawer;
        }else{
          this.loginDialog = true;
        }
      }
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
  }
}
</script>
