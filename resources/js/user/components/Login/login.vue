<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >


    <v-btn
      color="primary"
      @click="getNoti"
    >
      GetToken
    </v-btn>

  </v-form>
</template>

<script>
import firebase from 'firebase';
// import { askForPermissioToReceiveNotifications } from '../push-notification';
export default {
  methods:{
  async getNoti(){
    try {
      const messaging = firebase.messaging();
      await messaging.requestPermission();
      const token = await messaging.getToken();
      console.log('I got the token :', token);
      // this.profile.noti_token=token;
      // return token;
    } catch (error) {
      console.error(error);
    }
 },
}
}
</script>

<style lang="css" scoped>

</style>
