<template>
  <v-container >
    <v-row>
      <v-col
        md="3"
      >
        <v-card
          tile
          max-width="480"
          class=" mx-auto  mb-10"
          color="light-blue lighten-4"
          >
          <v-layout>
           <v-img
           :src="User.image"
           width="200px"
          height="200px"
          dark
    >
      <v-row class="fill-height">
        <v-card-title>
          <v-spacer></v-spacer>

        </v-card-title>

        <v-spacer></v-spacer>

        <v-card-title class="white--text pl-12 pt-12">
          <div class="display-1 pl-12 pt-12"></div>
        </v-card-title>
      </v-row>
    </v-img>
    </v-layout>

    <v-list>
      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">person</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{User.name}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">email</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title >{{User.email}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">phone</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{User.phone_no}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">public</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{User.nrc_no}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">cake</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{User.date_of_birth}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">class</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{User.course.name}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
            <v-icon color="accent">mdi-account-group</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
            <v-list-item-title>{{User.batch.name}}</v-list-item-title>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent" >home</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
          <v-list-item-title>{{User.address}}</v-list-item-title>
        </v-list-item-content>

      </v-list-item>
    </v-list>
  </v-card>
      </v-col>
      <v-col
        md="9"
      >

        <!-- <v-card
          class="pa-2"
          tile
        > -->
        <v-container style="height: calc(100% - 50px);width:100%;">
         <v-card>
            <v-item v-slot:default="{ active, toggle }">
              <v-card
                color="light-blue lighten-4"
                height="200"
                @click="toggle"
                class="pt-3"
              >
              <div class="display-1">
                Result for Assignment
              </div>
              <v-flex xs12 sm12 md12 lg12 xl12 >
                <v-layout>
                  <v-flex xs10 sm10 md9 lg9 xl9 class="ml-3 mt-3 headline">
                    Total Assignment
                    <div class="display-1 text-left ml-3">
                      {{total}}
                    </div>

                    <div class="text-left ml-3 headline">
                      Average
                    </div>

                     <div class="display-1 text-left ml-3">
                      {{average}}
                    </div>
                  </v-flex>
                  <v-flex xs2 sm2 md3 lg3 xl3 class="headline mr-3 mt-3">
                    Overall Grade
                  <p class="display-4 ml-3">{{grade}}</p>
                  </v-flex>
                </v-layout>

              </v-flex>
              </v-card>
            </v-item>
           </v-card>
          <v-card>
            <v-list two-line >
              <span class="grey">

              </span>
              <template v-for="result in results">

                <v-list-item :key="result.id" class="pa-3">
                      <v-list-item-content>
                        <v-list-item-title class="blue--text">
                          <div class="title" >
                            {{result.assignment.name}}
                          </div>
                        </v-list-item-title>
                        <div class="pt-8">

                        </div>
                        <v-list-item-subtitle>
                          {{result.comments}}
                        </v-list-item-subtitle>
                      </v-list-item-content>
                      <v-list-item-action>
                        <v-progress-circular
                            :rotate="90"
                            :size="90"
                            :width="8"
                            :value="result.marks"
                            :color='progresscolor(result.marks)'
                          >
                            {{ result.marks }}
                        </v-progress-circular>
                      </v-list-item-action>
                  </v-list-item>
                  <v-divider></v-divider>
                </template>
              </v-list>
          </v-card>
      </v-container>
        <!-- </v-card> -->
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
  import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data(){
      return{
        results:[],
        avg:0,      }
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      },
      grade(){
          if(this.average <= 40) {
            return "C";
          }else if (this.average <= 70){
              return "B";
            }else{
              return "A";
          }
      },
      total(){
        return this.results.length;
      },
      average(){
        var total_marks=0;
        for(var i=0; i <= this.results.length -1; i++){
            total_marks = this.results[i].marks + total_marks;
        }
        this.avg = (total_marks / this.results.length);
        return this.avg;
      },
    },
    methods:{
      progresscolor(mark)
      {
          if (mark <= 20){
             return"#F44336";
          }else if (mark <= 40){
             return "#FF5722";
          }else if (mark<= 60){
             return "#FFEB3B";
          }else if (mark <= 80){
             return "#EEFF41";
          }else{
             return "#8BC34A";
         }
      },
    getall(){
      console.log(this.User.token);
      this.$http.get(this.$root.api + '/results?student_id=' + this.User.id,{
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
          this.results = response.body.data;
          console.log(response.body.data);
        }, response =>{

        });
      }
    },

  created(){
    // this.getuser();
    this.getall();
  }
}










</script>
