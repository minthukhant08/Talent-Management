<template>
  <v-row>

      <v-menu
        v-model="menu2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        full-width
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-layout row ma-3>

            <v-flex xs0 sm0 md2 lg2 xl2>
              <img src="" alt="">
            </v-flex>

            <v-flex xs12 sm12 md8 lg8 xl8>
            <v-layout row ma-3>
              <v-card ma5
                class="mx-auto"
                width="100%"
                style="border-radius:10px;"
                color="accent"
              >
                <v-list>
                  <v-list-item>


                    <v-list-item-content>
                      <v-list-item-title><h3>Course Edit</h3></v-list-item-title><br><br>

                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md4 lg3 xl3
                          mt-7
                          ml-4
                          >
                            <v-list-item-text
                            >Name</v-list-item-text>
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            filled
                            v-model="courses.name"
                            color="accent"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                            <v-list-item-text
                            >Description</v-list-item-text>
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.descriptions"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                    </v-list-item-content>

                  </v-list-item>
                </v-list>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text>Remove</v-btn>
                  <v-btn
                   @click="updatecourse" text>Update</v-btn>

                </v-card-actions>
              </v-card>

              <v-card ma5
                class="mx-auto mt-5"
                width="100%"
                style="border-radius:10px;"
                color="accent"
                v-for="topic in courses.topic"
                :key="topic.id"
              >
                <v-list>
                  <v-list-item>


                    <v-list-item-content>
                      <v-list-item-title><h3>Topic Edit</h3></v-list-item-title><br><br>

                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md4 lg3 xl3
                          mt-7
                          ml-4

                          >
                            <v-list-item-text>Topic</v-list-item-text>
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="topic.topic"

                            filled
                            color="accent"
                           ></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                            <v-list-item-text>descriptions</v-list-item-text>
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="topic.descriptions"
                            filled
                            color="accent"
                           ></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                            <v-list-item-text>Date</v-list-item-text>
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                              v-model="topic.date"
                              prepend-icon="event"
                              readonly
                              v-on="on"
                            ></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                    </v-list-item-content>

                  </v-list-item>
                </v-list>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text>Remove</v-btn>
                  <v-btn @click="updatetopic" text>Update</v-btn>
                </v-card-actions>
              </v-card>

              <v-action>
                    <v-btn
                    class="ma-2"
                    outlined
                    color="accent"
                    >ADD<v-icon>add</v-icon></v-btn>
              </v-action>
            </v-layout>
            </v-flex>

            <v-flex xs12 sm12 md2 lg2 xl2>

            </v-flex>

          </v-layout>

        </template>
        <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
      </v-menu>

  </v-row>



</template>
<script>
  import commonmethods from '../../mixins/commonMethods';
  export default {

  mixins:[commonmethods],
  data(){
    return{
        editedcourse:[],
        courses:[],
        topics:[],
      }
  },
  methods:{


   updatecourse(){
      this.$http.put('http://localhost:8000/api/v1/courses/'+ this.$route.params.id, {

      name: this.courses.name,
      descriptions: this.courses.descriptions


      }).then((response) =>{
        this.goRoute('/course/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },
    updatetopic(){
      console.log("dfdf");
      console.log(this.topicss.topic);
      this.$http.put('http://localhost:8000/api/v1/topics/'+ this.$route.params.id, {

      topic: this.topics.topic,
      descriptions: this.topic.descriptions


      }).then((response) =>{
        // this.goRoute('/course/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },

    gettopic(){
      this.$http.get('http://localhost:9000/api/v1/topics/1').then(response => {

       this.topics = response.body.data;
      }, response =>{

      });
    },


    getCourse(){
      this.$http.get('http://localhost:8000/api/v1/courses/'+ this.$route.params.id).then((response) =>{
          console.log(response.body.data[0]);
          this.courses = response.body.data[0];
      })
      .then((error)=>{

      })

    }

  },
  created(){
   this.getCourse();
   this.gettopic();


  }
}
</script>
