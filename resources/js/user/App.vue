<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      color=secondary
    >
      <v-list dense>

        <v-list-item @click="goRoute('/')">
          <v-list-item-action>
            <v-icon>dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

<<<<<<< HEAD
        <v-list-item @click="goRoute('/course')">
          <v-list-item-action>
            <v-icon>book</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Courses</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/intake')">
          <v-list-item-action>
            <v-icon>textsms</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Intake</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
=======
<<<<<<< HEAD
        <v-list-item @click="goRoute('/userprofile')">
          <v-list-item-action>
            <v-icon>person</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>User</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="goRoute('/edit')">
          <v-list-item-action>
            <v-icon>person</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Edit</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
=======
          <v-list-item @click="goRoute('/activity')">
          <v-list-item-action>
            <v-icon>local_activity</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>activity</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
       


       <v-list-item @click="goRoute('/result')">
          <v-list-item-action>
            <v-icon>assignment</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>result</v-list-item-title>
          </v-list-item-content>
        </v-list-item>










        
>>>>>>> f1ae66544a2410e2dd91089ee43c515065916662
>>>>>>> master
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
      color=primary
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"><v-icon>menu</v-icon></v-app-bar-nav-icon>
      <div class="text-center pl-2 pr-2" >
        <v-avatar>
          <img src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB" alt="avatar">
        </v-avatar>
      </div>
      <v-toolbar-title class="pink--text" style="padding-top:25px;">Talent Program</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-fade-transition mode="out-in">
            <router-view></router-view>
      </v-fade-transition>
    </v-content>

    <v-footer app>
      <span>&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
      dark:false
    }),
    methods:{
      goRoute($route){
        this.$router.push($route).catch(err => {});
      },
      changemode(){
        this.$vuetify.theme.dark = this.dark;
      }
    },
    created () {
      this.$vuetify.theme.dark = true
    },
  }
</script>
