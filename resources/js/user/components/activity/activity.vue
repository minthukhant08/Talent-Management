<template>
    <div>
      <div class="text-center">
         <v-dialog
           v-model="commentDialog"
           width="400"
           height="350">
           <v-card>

            <v-list three-line>
              <template  v-for="comment in comments">
                <v-list-item
                  :key="comment.id"
                 >
                   <v-list-item-avatar>
                    <v-img :src="comment.user.image"></v-img>
                   </v-list-item-avatar>

                   <v-list-item-content >
                     <v-list-item-title >{{comment.user.name}}</v-list-item-title>
                    <v-chip
                    class="pa-5"
                    color="green accent-1"
                    text-color="white">
    
                      <v-list-item-subtitle>{{comment.descriptions}}</v-list-item-subtitle> 
                    </v-chip>
                  </v-list-item-content>
              </v-list-item>
             </template>
              <v-text-field
                v-model="comment_description"
                 class="ma-5"
                 width="20"
                 height="25"
                color="cyan"
                placeholder="Write your comment here..."
                outlined
                hide-details
                >
              </v-text-field>

               <v-card-actions>
                   <v-btn  color="accent" text @click="save()">Post</v-btn>
              </v-card-actions>
            </v-list>
           </v-card>
        </v-dialog>
        <v-dialog
          v-model="seemoreDialog"
          width="300"
          height="500"
        >
         <v-card
         class="mx-auto my-12"
         max-width="374"
        >
          <v-img
          height="250"
          :src="selectedActivity.image"
          >
          </v-img>

          <v-card-title>{{selectedActivity.name}}</v-card-title>
            <v-card-text>
              <v-row align="center">
                <v-rating
                  :value="4.5"
                  color="amber"
                  half-increments
                  dense
                  size="14"
                  readonly
                >
                </v-rating>
               <div class="grey--text ml-4">{{selectedActivity.speaker}}</div>
              </v-row>
               <div>{{selectedActivity.descriptions}}</div>
            </v-card-text>

           <v-divider class="mx-4"></v-divider>

            <v-card-text>
              <div class="title text--primary">{{selectedActivity.date}}</div>
             <v-chip-group
            active-class="deep-purple accent-4 white--text"
            column>
               <v-chip>5:30PM</v-chip>
               <v-chip>7:30PM</v-chip>
               <v-chip>8:00PM</v-chip>
               <v-chip>9:00PM</v-chip>
             </v-chip-group>
            </v-card-text>
             <v-card-actions>
                <v-btn
                color="deep-purple accent-4"
                >Reserve
                </v-btn>
             </v-card-actions>
          </v-card>
        </v-dialog>
<v-layout>
  <v-flex lg3 > </v-flex>
    <v-flex lg6>
      <v-card>
        <v-pagination
          v-model="page"
          :length="total_pages"
        >
        </v-pagination>
      <v-card  width="100%;" dark
        row
        v-for="(activity, index) in activities"
        :key="activity.id"
        class="ma-3">
      <v-img
      @click="seeMore(activity)"
      :src="activity.image"
      height="350">
      <v-layout class="fill-height align-end gradient-box" >
        <v-card-title >
          <span class="white--text text-left" >
            {{activity.name}}
          <div></div>
            <div class="subtitle-1">
            By {{activity.speaker}}
            </div>
          </span>
        </v-card-title>
      </v-layout>
      </v-img>
       <v-card-text class="pa-0 mr-0" >
            <v-layout>
              <v-flex xs7 sm7 md7 lg7 xl7>

              </v-flex>
              
               
              <v-flex xs3 sm3 md3 lg3 xl class="text-right">
                {{activity.likes}}Likes 

             
               
                   
                    </v-flex>
          
              <v-flex xs3 sm3 md3 lg3 xl3 class="">
                {{activity.comments}}Comments
              </v-flex>
            </v-layout>
          </v-card-text>
          <v-card-title class="pa-0 ma-0">
           <v-divider></v-divider>
          </v-card-title>
      <v-card-actions>
        <v-layout>
          <v-flex class="text-center">
            <v-btn icon   @click="total_like(activity.id, index)">
              <v-icon>favorite</v-icon>
            </v-btn>
          </v-flex>
         <v-flex class="text-center">
           <v-btn icon @click="getcomment(activity,index);">
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
    <v-pagination
          v-model="page"
          :length="total_pages"
        >
        </v-pagination>
          </v-card>
        </v-flex>

        <v-flex lg3 >
        </v-flex>

      </v-layout>
      </div>
    </div>
</template>

<script>
export default {
  data(){
    return{
      activities: [],
      comments:[],
      commentDialog:false,
      selectedActivity:{},
       select: [
          { text: 'State 1' },
          { text: 'State 2' },
          { text: 'State 3' },
          { text: 'State 4' },
          { text: 'State 5' },
          { text: 'State 6' },
          { text: 'State 7' },
        ],
      seemoreDialog: false,
      value:'',
      selected:'',
      page:1,
      total_pages:0,
      comment_description:[],
      selectedindex:0,
  
     }
  },
  watch:{
    page(val){
      console.log(val);
      this.$http.get(this.$root.api + '/activities?offset=' + (val-1)*5 + '&limit=5',{
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        console.log(response.body.data);
       this.activities = response.body.data;
      }, response =>{

      });
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{
    getcomment(activity,index){

      this.$http.get(this.$root.api + '/comments?activity_id=' + activity.id, {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        console.log(response);
        this.selectedActivity = activity;
        this.commentDialog = true;
        this.comments = response.body.data;
        this.selectedindex= index;

      }, response =>{

      });
    },
  seeMore(activity){
    this.seemoreDialog = true;
    this.selectedActivity = activity;
  },
  getall(){

      this.$http.get(this.$root.api + '/activities?offset=0&limit=5',{
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        this.total_pages = response.body.meta.total/5
       this.activities = response.body.data;
      }, response =>{

      });
    },

   save(){
        this.$http.post(this.$root.api+'/comments', {
          "descriptions":this.comment_description,
          "activity_id": this.selectedActivity.id,
          "user_id"     : this.User.id
      
        }).then((response) =>{
              this.comments.unshift({
                "descriptions":this.comment_description, 
                "activity_id": this.selectedActivity.id,
                "user" :{
                    "id" : this.User.id,
                    "name" : this.User.name,
                    "image" : this.User.image
                }
                });
          this.activities[this.selectedindex].comments +=1;
          this.dialog = false;
          
        })
        .then((error) =>{

        })
        },

  total_like(activity_id,index) {
      this.$http.post(this.$root.api+'/likes', {
         
          "activity_id": activity_id,
          "user_id"     : this.User.id
      
        
        }).then((response) =>{
             
              
          this.activities[index].likes +=1;
          this.dialog = false;
          
        })
        .then((error) =>{

        })
           }
  },
created(){
    this.getall();
  }
}



</script>
