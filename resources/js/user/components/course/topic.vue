<template>
<div>
<v-layout>
  <v-flex xs0 sm0 md2 lg1 xl1>
  </v-flex>
  <v-flex xs11 sm11 md8 lg10 xl10>
    <v-dialog v-model="dialog" max-width="500px">
      <v-card
        class="mx-auto"
        max-width="500"
        dark
        flat
      >
        <v-card-title class="pa-2 accent">
          Front-End Schedule
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-btn class="mx-2" fab dark small text color=primary
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
                v-for="n in 4"
                :key="n"
                small
              >
                <template v-slot:icon>
                    <v-avatar>
                      <img src="http://i.pravatar.cc/64">
                    </v-avatar>
                </template>

                <v-layout class="pb-3">
                  <v-flex cols="4">
                    <strong>12.07.2019</strong>
                  </v-flex>
                  <v-flex>
                      <strong>HTML</strong>
                      <div class="caption">HTML is Hypertext Markup Language</div>
                  </v-flex>
                </v-layout>
             </v-timeline-item>
           </v-timeline>
         </v-card-text>
      </v-card>
    </v-dialog>

    <v-timeline :dense="$vuetify.breakpoint.smAndDown">
      <v-timeline-item v-for="(card,index) in cards" :key="index"
        color="accent"
      >
      <span slot="opposite">Tus eu perfecto</span>
        <v-card >
          <v-card-title class="accent" >
            <h2 class="display-1 white--text font-weight-light">{{card.topic}}</h2>
          </v-card-title>
          <v-card-actions class="font-weight-medium  subtitle-1 pl-6 pb-0 pt-5" >
            <v-icon>event</v-icon>&nbsp;&nbsp;
               {{card.start_date}}&nbsp;-&nbsp;
               {{card.end_date}}
         </v-card-actions>
          <v-container class="pt-0">
            <v-layout>
              <v-flex cols="12" md="12">
                  <v-card-text>
                    {{card.descriptions}}
                  </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn @click.stop="dialog = true" color=accent text>
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
      cards:[],
      dialog:false
    }
  },

  methods:{
    goRoute($route){
      this.$router.push($route).catch(err => {});
    },
    getCourseDetail(){
      this.$http.get('http://localhost:8000/api/v1/courses/'+this.$route.params.id).then(response=>{
        //console.log(response.body.data);
        this.cards= response.body.data[0].topic;
      }, response => {
        console.log('error');
      })
    }
  },
  created(){
    this.getCourseDetail();
  }
}
</script>
