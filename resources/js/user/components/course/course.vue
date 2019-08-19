<template>
  <!-- <v-layout row>
    <v-flex xs0 sm0 md1 lg1 xl1>
    </v-flex>

    <v-flex xs12 sm12 md10 lg10 xl10> -->
      <v-layout row pl-5 pr-5 pt-3>
        <v-flex xs12 sm6 md3 lg3 xl3
          v-for="(course,index) in courses"
          :key="index"
          class="pa-1">
          <v-hover
             v-slot:default="{hover}"
             open-delay="200"
             >
             <v-card width="100%" height="100%"
               :elevation="hover ? 16 : 2"
               @click="goRoute('/topic/'+ course.id)"

             >
               <v-img
                 class="white--text"
                 :aspect-ratio="16/9"
                 :src="course.image"

               ><v-card-title class="align-end fill-height">

                     {{course.name}}

                </v-card-title>
                </v-img>

               <v-card-text class="font-weight-medium  subtitle-1" >
                     <v-icon dark >event</v-icon>
                        <span class="blue--text" >StartDate:</span>
                        <span class="white--text">{{course.start_date}}</span>
                          <v-spacer></v-spacer>
                     <v-icon dark >
                       event
                     </v-icon>
                     <span class="blue--text">
                       EndDate:
                     </span>
                     <span class="white--text">
                       {{course.end_date}}
                     </span>
              </v-card-text>

               <v-card-text class="font-weight-medium  subtitle-1" >
                 <p class="font-weight-light"><span class="white--text">{{course.descriptions}}</span></p>



               </v-card-text>
             </v-card>
           </v-hover>
        </v-flex>
      </v-layout>
    <!-- </v-flex>

    <v-flex xs0 sm0 md1 lg1 xl1>
    </v-flex>
  </v-layout> -->
</template>


<script>
export default{
  data(){
    return{
      courses:[],
      dialog:false
    }
  },
  methods:{
    goRoute($route){
      this.$router.push($route).catch(err => {});
    },
    getCourses(){
      this.$http.get('http://localhost:8000/api/v1/courses').then(response=>{
        // console.log(response.body.data);
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
