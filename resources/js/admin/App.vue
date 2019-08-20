<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      color=secondary
    >
      <v-list >
        <v-list-item @click="goRoute('/profile/1')">
          <v-list-item-action class="mr-3">
            <v-avatar><img :src='User.image' alt="avatar"></v-avatar>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="User.name"></v-list-item-title>
            <v-list-item-subtitle v-text="User.email"></v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/course')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Courses</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/activity')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Activity</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/results')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Results</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/giveresults')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Give Results</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/assignments')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Assignments</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/course')">
          <v-list-item-action>
            <v-icon>person</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Course</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/courseedit')">
          <v-list-item-action>
            <v-icon>person</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Course Edit</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/batch')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Batch</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="goRoute('/admin/activity')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Activity</v-list-item-title>
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
      <div class="text-center pl-2 pr-2" >
        <v-avatar>
          <img src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB" alt="avatar">
        </v-avatar>
      </div>
      <v-toolbar-title class="pink--text" style="padding-top:25px;">Talent Program</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-menu
        :close-on-content-click="false"
        :nudge-width="200"
        offset-x
      >
        <template icon v-slot:activator="{ on }" v-show="">
          <v-btn class="mr-3" v-on="on" text>
            <v-badge>
              <span slot="badge" class="red--text" v-if='showBadge!=0'>{{showBadge}}</span>
              <v-icon color='white'>
                notifications
              </v-icon>
            </v-badge>
          </v-btn>
        </template>
        <app-noti></app-noti>
      </v-menu>
    </v-app-bar>

    <v-content>
      <v-fade-transition mode="out-in">
            <router-view></router-view>
      </v-fade-transition>
    </v-content>

    <v-footer dark>
      <span>&copy; 2019</span>
    </v-footer>
    <v-dialog v-model="loginDialog" max-width="400px">
        <v-card width="100%;" class="py-5">
          <v-card-text class="text-center">
            <img
            src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB"
            alt="logo"
            pt-4
            :aspect-ratio="1">
            <v-btn color=info block class="mb-3">
                <v-icon>fa fa-facebook</v-icon>
                   &nbsp;&nbsp;Sign in with Facebook
            </v-btn>
            <v-btn block @click="googleLogin">
                <v-icon>fa fa-google</v-icon>
                   &nbsp;&nbsp;Sign in with Google
            </v-btn>
          </v-card-text>
        </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import firebase from 'firebase';
export default {
  components:{
    'app-noti' : noti,
  },
    data(){
      return{
        drawer: null,
        dark:false,
        loginDialog:false
      }
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
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
      getNotification(){
        this.$http.get('http://localhost:8000/api/v1/notifications/10').then((response)=>{
          console.log(response.body.data);
          this.$store.dispatch('setNoti',response.body.data);
        })
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
