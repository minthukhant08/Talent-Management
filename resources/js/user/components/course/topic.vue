<template>
<div>
<v-layout>
  <v-flex xs0 sm0 md2 lg1 xl1>
  </v-flex>
  <v-flex xs11 sm11 md8 lg10 xl10>
    <v-dialog v-model="topicdetaildialog" max-width="500px">
      <v-card
        class="mx-auto"
        max-width="500"
        dark
        flat
      >
        <v-card-title class="pa-2 purple lighten-3">
          Front-End Schedule
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-btn class="mx-2" fab dark small text color="accent"
                @click="dialog = false"
              >
                <v-icon>close</v-icon>
              </v-btn>
            </v-card-actions>
        </v-card-title>
        <v-card-text class="py-0" >
            <v-timeline
              align-top
              dense
            >
              <v-timeline-item

                small
              >
                <template v-slot:icon>
                    <v-avatar>
                      <img src="http://i.pravatar.cc/64">
                    </v-avatar>
                </template>

                <v-layout class="pb-3">
                  <v-flex cols="4">
                    <strong>{{topicdetails.start_date}}</strong>
                  </v-flex>
                  <v-flex>
                      <strong>{{topicdetails.topic}}</strong>
                      <div class="caption">{{topicdetails.descriptions}}</div>
                  </v-flex>
                </v-layout>
             </v-timeline-item>
           </v-timeline>
         </v-card-text>
      </v-card>
    </v-dialog>

    <v-timeline :dense="$vuetify.breakpoint.smAndDown">
      <v-timeline-item v-for="(topic,index) in topics" :key="index"
        color="purple lighten-2"
      >
      <span slot="opposite">Tus eu perfecto</span>
        <v-card >
          <v-card-title class="purple lighten-2" >
            <h2 class="display-1 white--text font-weight-light">{{topic.topic}}</h2>
          </v-card-title>
          <v-container>
            <v-layout>
              <v-flex cols="12" md="12">
                  <v-card-text>{{topic.descriptions}}</v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn @click="topicdialog(topic)" color=accent text>
                          Schedule
                      </v-btn>
                    </v-card-actions>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
      </v-timeline-item>
    </v-timeline>
</v-flex>

<v-flex xs0 sm0 md2 lg1 xl1>
</v-flex>
  <v-btn class="mx-2" fab dark color="indigo" fixed bottom right
    @click="goRoute('/courses')"
  >
    <v-icon dark>keyboard_arrow_left</v-icon>
  </v-btn>
</v-layout>
</div>
</template>

<script>
export default{
  data(){
    return{

      topics:[],
      topicdetails:{},
      topicdetaildialog: false,

    }
  },

  methods:{
    goRoute($route){
      this.$router.push($route).catch(err => {});
    },

    gettopicdetail(){
      this.$http.get('http://localhost:8000/api/v1/topics'+this.$route.params.id).then(response=>{
        console.log(response.body.data);
        this.topic= response.body.data;
      }, response => {
        console.log('error');
      })
    },
    topicdialog(topic){
      this.topicdetaildialog=true;
      this.topicdetails=topic;
    },


    getCourseDetail(){
      this.$http.get('http://localhost:8000/api/v1/courses/'+this.$route.params.id).then(response=>{
        //console.log(response.body.data);
        this.topics= response.body.data[0].topic;
      }, response => {
        console.log('error');
      })
    }
  },
  created(){
    this.getCourseDetail();
    this.gettopicdetail();
  }
}
</script>
