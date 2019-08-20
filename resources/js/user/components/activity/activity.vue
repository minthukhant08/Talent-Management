<template>
    <div>
       <v-dialog
          v-model="dialog"
          width="300"
          height="500"
        >
          <v-card>
            <v-list three-line>
             <template  v-for="comment in comments">
                <v-list-item

                  :key="comment.id"
                  @click="comment"
                >
                  <v-list-item-avatar>
                    <v-img :src="comment.user.image"></v-img>
                  </v-list-item-avatar>

                  <v-list-item-content>
                    <v-list-item-title >{{comment.user.name}}</v-list-item-title>
                    <v-list-item-subtitle> {{comment.descriptions}}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </template>

              <v-text-field
                v-model="value"
                color="cyan darken"
                placeholder="Start typing..."
                loading
              >
                <template v-slot:progress>
                  <v-progress-linear
                    v-if="custom"
                   :value="progress"
                   :color="color"
                   absolute
                   height="7">
                  </v-progress-linear>
                </template>
              </v-text-field>
            </v-list>
          </v-card>
      </v-dialog>
      <v-layout
         row
         v-for="activity in activities"
         :key="activity.id"
         pt-5
      >
        <v-flex lg3 >
        </v-flex>

        <v-flex lg6>
          <v-card  width="100%;" dark>
             <v-img
              :src="activity.image"
              height="300"
              >
                <v-card-title class="fill-height align-end gradient-box" >
                  <span class="white--text">
                    {{activity.name}}
                    <div></div>
                    By {{activity.speaker}}
                   </span>
                </v-card-title>
            </v-img>
           <v-card-actions>
              <v-layout>

                <v-flex class="text-center">
                  <v-btn icon>
                    <v-icon>favorite</v-icon>
                  </v-btn>
                </v-flex>

                <v-flex class="text-center">
                   <v-btn icon @click="comment(activity.id)">
                      <v-icon>insert_comment</v-icon>
                   </v-btn>
                </v-flex>

                <v-flex class="text-center">
                  <v-btn icon>
                      <v-icon>share</v-icon>
                  </v-btn>
                </v-flex>

              </v-layout>
            </v-card-actions>
          </v-card>
        </v-flex>

        <v-flex lg3 >
        </v-flex>

      </v-layout>
    </div>
</template>

<script>
export default {
  data(){
    return{
      activities: [],
      comments:[],
      dialog: false,
      value:'',
    }
  },
  methods:{
    comment($activity_id){
      console.log($activity_id);
      this.$http.get('http://localhost:8000/api/v1/comments?activity_id='+$activity_id).then(response => {
        console.log(response);
      this.comments = response.body.data;
       this.dialog = true;
      }, response =>{

      });
    },
    getall(){
      this.$http.get('http://localhost:8000/api/v1/activities').then(response => {
        console.log('ssdfsd');
       this.activities = response.body.data;
      }, response =>{

      });
    }
  },

  created(){
    this.getall();
  }
}


</script>
