<template>
  <v-card
    max-width="480"
    class="mx-auto mt-10 mb-10"
  >
    <v-img
      :src="user.image"
      height="300px"
      dark
    >
      <v-row class="fill-height">
        <v-card-title>
          <v-spacer></v-spacer>

        </v-card-title>

        <v-spacer></v-spacer>

        <v-card-title class="white--text pl-12 pt-12">
          <div class="display-1 pl-12 pt-12"></div>
        </v-card-title>
      </v-row>
    </v-img>

    <v-list>
      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">person</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{user.name}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">email</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title >{{user.email}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">phone</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{user.phone_no}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">public</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{user.nrc_no}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">cake</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{user.date_of_birth}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">class</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{user.course.name}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
            <v-icon color="accent">group</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
            <v-list-item-title>{{user.batch.name}}</v-list-item-title>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent" >home</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{user.address}}</v-list-item-title>
        </v-list-item-content>

      </v-list-item>

      <v-divider inset></v-divider>


      <v-list-item >
        <v-list-item-content >
           <v-btn
            color="accent"
            @click="goRoute('/editprofile')"
            >Edit</v-btn>

        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-content >
           <v-btn
            color="accent"

            >Log Out</v-btn>


        </v-list-item-content>

      </v-list-item>








    </v-list>
  </v-card>
</template>


<script >
import commonmethods from '../../mixins/commonMethods';
export default {
  mixins:[commonmethods],
  data(){
    return{
        user:[],
      }
  },
  methods:{
    getuser(){
      this.$http.get(this.$root.api + '/users/' + this.$route.params.id, {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
          this.user = response.body.data[0];
          console.log(response.body.data[0]);
      }, response => {

      });
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  created(){
  	this.getuser();
  }
}
</script>
