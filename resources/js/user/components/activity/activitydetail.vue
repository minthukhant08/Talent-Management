  <template>
  <v-container>
    <v-layout>
    <v-flex lg1 > </v-flex>
      <v-flex lg10>
  <v-card
    class="mx-auto"
  >
    <v-list-item>
      <v-list-item-avatar color="grey">
        <v-img :src="activity.image"></v-img>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="headline">{{activity.name}}</v-list-item-title>
        <v-list-item-subtitle>by {{activity.speaker}}</v-list-item-subtitle>
      </v-list-item-content>
      <v-list-item-action>
        <social-sharing :url="'https://api.astrosubs.com/activity' + activity.id"
                      :title="activity.name"
                      :description="activity.descriptions"
                      :quote="activity.descriptions"
                      hashtags="talent"
                      twitter-user="vuejs"
                      inline-template>
       <v-speed-dial
         v-model="fab"
         direction="left"
       >
         <template v-slot:activator>
           <v-btn
             v-model="fab"
             text
             fab
             dark
           >
             <v-icon v-if="fab">mdi-close</v-icon>
             <v-icon v-else>share</v-icon>
           </v-btn>
         </template>
         <v-btn
           fab
           dark
           small
           color="info"
         >
          <network network="twitter">
            <v-icon class="fa fa-fw fa-twitter"></v-icon>
          </network>
         </v-btn>
         <v-btn
           fab
           dark
           small
           color="indigo"
         >
          <network network="facebook">
            <v-icon class="fa fa-fw fa-facebook"></v-icon>
          </network>
         </v-btn>
         <v-btn
           fab
           dark
           small
           color="red"
         >
         <network network="reddit">
           <v-icon class="fa fa-fw fa-reddit"></v-icon>
         </network>
         </v-btn>
         <v-btn
           fab
           dark
           small
           color="info"
         >
         <network network="linkedin">
           <v-icon class="fa fa-linkedin"></v-icon>
         </network>
         </v-btn>
       </v-speed-dial>
     </social-sharing>
      </v-list-item-action>
    </v-list-item>

    <v-img
     :src="activity.image"
      :aspect-ratio="16/7"
    ></v-img>

    <v-card-text>
     {{activity.descriptions}}
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-icon @click="postlike">favorite</v-icon>
       &nbsp;&nbsp; {{activity.like.likes}} likes &nbsp;&nbsp; &nbsp;&nbsp;
      <v-icon>insert_comment</v-icon>
       &nbsp;&nbsp; {{activity.comments}} comments
    </v-card-actions>
    <v-divider></v-divider>
      <v-text-field
        v-model="comment_description"
          class="ma-5 mb-1"
          width="20"
          height="25"
        color="cyan"
        placeholder="Write your comment here..."
        outlined
        hide-details
        @keyup.enter="postcomment"
        >
      </v-text-field>

      <div class="ma-4" >
        <v-list three-line>
          <template v-for="comment in comments">
            <v-list-item
              :key="comment.id"
              >
                <v-list-item-avatar>
                <v-img aspect-ratio="1"  :src="comment.user.image" ></v-img>
                </v-list-item-avatar>

                <v-list-item-content >
                  <v-list-item-title>{{comment.user.name}}</v-list-item-title>
                  <v-list-item-subtitle >{{comment.descriptions}}</v-list-item-subtitle>
              </v-list-item-content>

          </v-list-item>
           <v-divider inset></v-divider>

          </template>
    </v-list>
      </div>
  </v-card>
  </v-flex>
  <v-flex lg1 > </v-flex>
  </v-layout>
  </v-container>
</template>
<script>
export default {
  data(){
    return{
      fab:false,
      comments:[],
      activity:{},
      comment_description:''
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{
     getcomment(){
      this.$http.get(this.$root.api + '/comments?activity_id=' + this.$route.params.id, {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        this.comments = response.body.data;
      }, response =>{

      });
    },
    getactivity(){
      this.$http.get(this.$root.api + '/activities/' + this.$route.params.id + "&activity_id=" + this.User.id, {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        this.activity = response.body.data[0];
      }, response =>{

      });
    },
    postcomment(){
      this.$http.post(this.$root.api+'/comments', {
          "descriptions":this.comment_description,
          "activity_id": this.$route.params.id,
          "user_id"     : this.User.id

        },
        {
          headers: {
              Authorization: 'Bearer '+ this.User.token
          }
        }).then((response) =>{
              this.comments.unshift({
                "descriptions":this.comment_description,
                "activity_id": this.$route.params.id,

                "user" :{
                    "id" : this.User.id,
                    "name" : this.User.name,
                    "image" : this.User.image
                }

          });
          this.activity.comments +=1;
          this.comment_description="";
        })
        .then((error) =>{

        })
    },
    postlike(){
       this.$http.post(this.$root.api+'/likes', {

          "activity_id" :  this.$route.params.id,
          "user_id"     : this.User.id

        },
        {
          headers: {
              Authorization: 'Bearer '+ this.User.token
          }
        }).then((response) =>{
          this.activity.likes +=1;
        })
        .then((error) =>{

        })
    }
  },
  created(){
    this.getactivity();
    this.getcomment();
  }

}
</script>
