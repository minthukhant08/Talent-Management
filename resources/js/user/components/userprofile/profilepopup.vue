<template >
  <v-card class="pa-2">
        <v-list>
          <v-list-item>
            <v-list-item-avatar>
              <img :src="User.image" alt="profile">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>{{User.name}}</v-list-item-title>
              <v-list-item-subtitle>{{User.type}}</v-list-item-subtitle>
              <v-list-item-subtitle>{{User.email}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list>
          <v-list-item>
            <v-list-item-action>
              <v-switch v-model="noti" color="accent"></v-switch>
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

        </v-list>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color=accent @click='logout'>Logout</v-btn>
        </v-card-actions>
      </v-card>
</template>
<script>
import commonmethods from '../../mixins/commonMethods';
import firebase from 'firebase';
export default{
  mixins:[commonmethods],
  data(){
    return{
      darkmode:false,
      noti:false
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
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
    async getNotiToken(){
      try {
        const messaging = firebase.messaging();
        await messaging.requestPermission();
        const token = await messaging.getToken();
        console.log('I got the token :', token);
      } catch (error) {
        console.error(error);
      }
   },
  },
  created(){
    this.darkmode = this.$store.getters.getMode;
    this.noti = this.$store.getters.isNotiSubscribed;
  }
}
</script>
