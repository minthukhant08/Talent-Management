<template>
  <v-layout row class="pt-3">
    <v-flex xs0 sm1 md2 lg2 xl2>
    </v-flex>

    <v-flex xs12 sm10 md8 lg8 xl8>
      <v-layout row >
        <v-flex xs12 sm6 md4 lg4 xl4
          v-for="(course,index) in courses"
          :key="index"
          class="pa-4">
          <v-hover  v-slot:default="{hover}">
             <v-card width="100%" height="100%"
               :elevation="hover ? 16 : 5"
               @click="goRoute('/courses/'+ course.id)"
               dark
             >
               <v-img
                 :aspect-ratio="16/12"
                 :src="course.image"
               >
                <v-card-title class="align-end fill-height gradient-box">
                  {{course.name}}
                </v-card-title>
              </v-img>

               <v-card-text class="font-weight-medium  subtitle-1" >
                 <v-icon>event</v-icon>
                    <span class="blue--text">
                      StartDate:
                    </span>
                    {{course.start_date}}
                 <v-spacer></v-spacer>
                 <v-icon>event</v-icon>
                   <span>
                     EndDate:
                   </span>
                    {{course.end_date}}
              </v-card-text>

               <v-card-text class="font-weight-medium  subtitle-1" >
                 <p class="font-weight-light">{{course.descriptions}}</p>
               </v-card-text>
             </v-card>
           </v-hover>
        </v-flex>
      </v-layout>
    </v-flex>

    <v-flex xs0 sm1 md2 lg2 xl2>
    </v-flex>
  </v-layout>
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
