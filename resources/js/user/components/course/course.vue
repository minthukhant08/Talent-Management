<template>
  <v-container>
    <v-layout row >
      <v-flex xs12 sm6 md4 lg4 xl4
        v-for="(course,index) in courses"
        :key="index"
        class="pa-3">
        <v-hover  v-slot:default="{hover}">
           <v-card width="100%" height="100%"
             :elevation="hover ? 16 : 3"
             @click="goRoute('/courses/'+ course.id)"
           >
             <v-img
               :aspect-ratio="16/12"
               :src="course.image"
             >
              <v-card-title class="white--text align-end fill-height gradient-box">
                {{course.name}}
              </v-card-title>
            </v-img>
            <v-card-actions class="font-weight-medium  subtitle-1" >
                <v-icon class="pa-1">event</v-icon>&nbsp;&nbsp;
                 {{course.start_date}}&nbsp;-&nbsp;
                 {{course.end_date}}
           </v-card-actions>

             <v-card-text class="font-weight-medium  subtitle-1" >
               <p class="font-weight-light">{{course.descriptions}}</p>
             </v-card-text>
           </v-card>
         </v-hover>
      </v-flex>
    </v-layout>
  </v-container>
</template>


<script>
import commonmethods from '../../mixins/commonMethods';
export default {
  mixins:[commonmethods],
  data(){
    return{
      courses:[],
      dialog:false
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{
    getCourses(){
      this.$http.get(this.$root.api + '/courses',{
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response=>{
        this.courses= response.body.data;
      }, response => {
        console.log('error');
      })
    }
  },
  created(){
    this.getCourses();
  }
}
</script>
