<template>
    <div>
      <v-btn fixed right bottom fab><v-icon>mid-plus</v-icon></v-btn>
       <v-dialog
          v-model="commentDialog"
          width="300"
          height="500"
        >
          <v-card>
            <v-list three-line>
              <template  v-for="comment in comments">
                <v-list-item
                  :key="comment.id"
                  @click="getcomment">
                  <v-list-item-avatar>
                    <v-img :src="comment.user.image"></v-img>
                  </v-list-item-avatar>

                  <v-list-item-content>
                    <v-list-item-title >{{comment.user.name}}</v-list-item-title>
                    <v-list-item-subtitle>{{comment.descriptions}}</v-list-item-subtitle>
                  </v-list-item-content>

                </v-list-item>
              </template>
              <v-text-field
                v-model="value"
                class="pa-3"
                color="cyan"
                placeholder="Start typing..."
                outlined
                hide-details >
             </v-text-field>
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
        v-for="activity in activities"
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
              <v-flex xs8 sm8 md8 lg8 xl8>

              </v-flex>
              <v-flex xs2 sm2 md2 lg2 xl2 class="text-right pr-1">
                {{activity.likes}}Likes
              </v-flex>
              <v-flex xs2 sm2 md2 lg2 xl2 class="text-right pr-1">
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
            <v-btn icon>
              <v-icon>favorite</v-icon>
            </v-btn>
          </v-flex>
         <v-flex class="text-center">
           <v-btn icon @click="getcomment(activity.id);">
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
      likecount:{},
      commentcount:{},

     }
  },
  watch:{
    page(val){
      console.log(val);
      this.$http.get('http://localhost:9000/api/v1/activities?offset=' + (val-1)*5 + '&limit=5').then(response => {
        console.log(response.body.data);
       this.activities = response.body.data;
      }, response =>{

      });
    }
  },
  methods:{
    getcomment($activity_id){

      this.$http.get('http://localhost:8000/api/v1/comments?activity_id=' + $activity_id).then(response => {
        console.log(response);
         this.commentDialog = true;
      this.comments = response.body.data;

      }, response =>{

      });
    },
  seeMore(activity){
    this.seemoreDialog = true;
    this.selectedActivity = activity;
  },
  getall(){
      this.$http.get('http://localhost:9000/api/v1/activities?offset=0&limit=5').then(response => {
        this.total_pages = response.body.meta.total/5
       this.activities = response.body.data;
      }, response =>{

      });
    },

   getlikecount(activity){
       this.likecount=activity;
    },

   getcommentcount(activity){
       this.commentcount=activity;
    },

    commentcolor(commenttype)
      {
          if (commenttype<= 20){
             return"#F44336";
          }else if (commenttype <= 40){
             return "#FF5722";
          }else{
             return "#8BC34A";
         }
         },
   },
created(){
    this.getall();
  }
}



</script>
