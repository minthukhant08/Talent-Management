<template>
<div>
<v-layout>
  <v-flex xs0 sm0 md2 lg1 xl1>
  </v-flex>
  <v-flex xs11 sm11 md8 lg10 xl10>
    <v-dialog v-model="topicdetaildialog" max-width="500px">
      <v-card
        class="mx-auto"
        max-width="900px"
        dark
        flat
      >
        <v-card-title class="pa-2 accent">
          Front-End Schedule
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-btn class="mx-2" fab dark small text color="accent"
                @click="close()"
              >
                <v-icon>close</v-icon>
              </v-btn>
            </v-card-actions>
        </v-card-title>
        <template v-for="detail in topicdetails">
          <v-card-text  >
              <v-timeline
                align-top
                dense
              >
                <v-timeline-item
                  small
                >
                  <template v-slot:icon>
                      <v-avatar class="mt-5">
                        <img :src="detail.teacher.image">
                      </v-avatar>
                  </template>

                  <v-layout>
                    <v-flex xs4 sm4 md4 lg4 xl4>
                      <strong>{{detail.date}}</strong>
                    </v-flex>
                    <v-flex xs8 sm8 md8 lg8 xl8>
                        <strong>{{detail.topic}}</strong>
                        <div class="caption">{{detail.descriptions}}</div>
                    </v-flex>
                  </v-layout>
               </v-timeline-item>
             </v-timeline>
           </v-card-text>
        </template>
      </v-card>
    </v-dialog>

    <v-timeline :dense="$vuetify.breakpoint.smAndDown">
      <v-timeline-item v-for="(topic,index) in topics" :key="index"
        color="accent"
      >
      <span slot="opposite">Tus eu perfecto</span>
        <v-card >
          <v-card-title class="accent" >
            <h2 class="display-1 white--text font-weight-light">{{topic.topic}}</h2>
          </v-card-title>
          <v-card-actions class="font-weight-medium  subtitle-1 pl-6 pb-0 pt-5" >
            <v-icon>event</v-icon>&nbsp;&nbsp;
               {{topic.start_date}}&nbsp;-&nbsp;
               {{topic.end_date}}
         </v-card-actions>
          <v-container class="pt-0">
            <v-layout>
              <v-flex cols="12" md="12">
                  <v-card-text>
                    {{topic.descriptions}}
                  </v-card-text>
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
  <v-btn class="mx-2" fab dark color="accent" fixed bottom right
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
  computed:{
      User(){
        return this.$store.getters.getUser;
      }
  },
  methods:{
    goRoute(route){
      this.$router.push(route).catch(err => {});
    },
    topicdialog(topic){
      this.$http.get(this.$root.api + '/topics/' + topic.id, {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response=>{
        console.log(response.body.data);
        this.topicdetaildialog=true;
        this.topicdetails=response.body.data[0].detail;
      }, response => {
        console.log('error');
      })

    },


    getCourseDetail(){
      this.$http.get(this.$root.api + '/courses/'+this.$route.params.id,{
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response=>{
        //console.log(response.body.data);
        this.topics= response.body.data[0].topic;
      }, response => {
        console.log('error');
      })
    }
  },
  created(){
    this.getCourseDetail();
  },
  close() {
    this.dialog = false
    setTimeout(()=>{
      this.editedItem = Object.assign({}, this.defaultItem)
      this.editedIndex = -1
    },300)
  }
}
</script>
