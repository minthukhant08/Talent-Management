<template>

  <v-row>

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
                      <v-list-item-title><h3>Topic Edit</h3></v-list-item-title><br><br>

                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs12 sm12 md4 lg3 xl3
                          mt-7
                          ml-4
                          >
                            Topic
                          </v-flex>
                          <v-flex xs12 sm12 md8 lg8 xl8>
                            <v-text-field
                            filled
                            v-model="topic.topic"
                            color="accent"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs12 sm12 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Description
                          </v-flex>
                          <v-flex xs12 sm12 md8 lg8 xl8>
                            <v-text-field
                            v-model="topic.descriptions"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs12 sm12 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                             Start Date
                          </v-flex>
                          <v-flex xs12 sm12 md8 lg8 xl8>
                            <v-text-field
                              v-model="topic.start_date"
                              prepend-icon="event"
                              readonly
                            ></v-text-field>
                          </v-flex>

                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs12 sm12 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                            End Date
                          </v-flex>
                          <v-flex xs12 sm12 md8 lg8 xl8>
                            <v-text-field
                              v-model="topic.end_date"
                              prepend-icon="event"
                              readonly
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
                  <v-btn
                  text>Update</v-btn>

                </v-card-actions>
              </v-card>
              <v-card ma5
                class="mx-auto mt-5"
                width="100%"
                style="border-radius:10px;"
                color="accent"
                v-for="(topicdetail,index) in topic.detail"
                :key="index"
              >
              <v-list>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title><h3>Topic Detail Edit</h3></v-list-item-title><br><br>
                    <v-list-item>
                      <v-layout row ma3>
                        <v-flex xs12 sm12 md4 lg3 xl3
                        mt-7
                        ml-4
                        >
                          Name
                        </v-flex>
                        <v-flex xs12 sm12 md8 lg8 xl8>
                          <v-text-field
                          v-model="topic.detail[index].name"

                          filled
                          color="accent"
                         ></v-text-field>
                        </v-flex>
                      </v-layout>
                    </v-list-item>
                    <v-list-item>
                      <v-layout row ma3>
                        <v-flex xs12 sm12 md3 lg3 xl3
                        mt-7
                        ml-4
                        >
                          Descriptions
                        </v-flex>
                        <v-flex xs12 sm12 md8 lg8 xl8>
                          <v-text-field
                          v-model="topic.detail[index].descriptions"
                          filled
                          color="accent"
                         ></v-text-field>
                        </v-flex>
                      </v-layout>
                    </v-list-item>
                    <v-list-item>
                      <v-layout row ma3>
                        <v-flex xs12 sm12 md3 lg3 xl3
                        mt-7
                        ml-4
                        >
                          Date
                        </v-flex>
                        <v-flex xs12 sm12 md8 lg8 xl8>
                          <v-text-field
                            v-model="topic.detail[index].date"
                            prepend-icon="event"
                            readonly
                            @click= "showDatePicker(index, topic.detail[index].date, 'start')"
                          ></v-text-field>
                        </v-flex>

                      </v-layout>
                    </v-list-item>
                    <v-list-item>
                      <v-layout row ma3>
                        <v-flex xs12 sm12 md3 lg3 xl3
                        mt-7
                        ml-4
                        >
                          Teacher
                        </v-flex>
                        <v-flex xs12 sm12 md8 lg8 xl8>
                          <v-text-field
                          v-model="topic.detail[index].teacher.name"
                          filled
                          color="accent"
                          ></v-text-field>
                        </v-flex>

                      </v-layout>
                    </v-list-item>
                  </v-list-item-content>

                </v-list-item>
              </v-list>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="removetopicdetail(topic, index)">Remove</v-btn>
                <v-btn @click="updatetopic(topic.id, index)" text>Update</v-btn>
              </v-card-actions>
              </v-card>
              <v-layout>
                <v-spacer></v-spacer>
                    <v-btn
                    v-model="detail"
                    class="ma-2"
                    outlined
                    color="accent"
                    @click="detail=true"
                    >ADD<v-icon>add</v-icon></v-btn>
                  </v-layout>

            </v-layout>
            </v-flex>

            <v-flex xs12 sm12 md2 lg2 xl2>

            </v-flex>

          </v-layout>
          <v-dialog v-model="datepicker" max-width="300">
            <v-date-picker v-model="picker" @change="changeDate()"></v-date-picker>
          </v-dialog>
          <v-dialog
            v-model="detail"
            width="500"
            style="border-radius:10px;"
          >
            <v-card>
              <v-card-title
                class="headline accent"
                primary-title
              >
                Add Topic Detail
              </v-card-title>

              <!-- <v-layout row>
                <v-flex xs12 sm12 md12 lg12 xl12 > -->
                <v-card-content class="ma-3">
                  <v-layout row class="ma-5">
                    <v-flex xs12 sm12 md3 lg3 xl3 pl-1 mt-6>
                      Name
                    </v-flex>
                    <v-flex xs12 sm12 md9 lg9 xl9>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm12 md3 lg3 xl3 pl-1 mt-6>
                      Description
                    </v-flex>
                    <v-flex xs12 sm12 md9 lg9 xl9>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm12 md3 lg3 xl3 pl-1 mt-6>
                      Date
                    </v-flex>
                    <v-flex xs12 sm12 md9 lg9 xl9>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm12 md3 lg3 xl3 pl-1 mt-6>
                      Teacher
                    </v-flex>
                    <v-flex xs12 sm12 md9 lg9 xl9>
                      <v-autocomplete
                        :items="components"
                      ></v-autocomplete>
                    </v-flex>
                  </v-layout>

                </v-card-content>

                    <!-- </v-flex>
              </v-layout> -->
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="accent"
                  text
                  @click="detail = false"
                >
                  POST
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

  </v-row>
</template>
<script>
  import commonmethods from '../../mixins/commonMethods';
  export default {

  mixins:[commonmethods],
  data(){
    return{
      components:['hello','world'],
        editedtopic:[],
        topic:[],
        topicdetail:[],
        datepicker:false,
        detail:false,
        picker:'',
        currenttextbox:'',
        datetype:''
      }
  },
  computed:{
    User(){
      this.$store.getters.getUser;
    }
  },
  methods:{
   changeDate(){
     if (this.datetype == "end") {
       this.topic[this.currenttextbox].end_date = this.picker;
     }else{
       this.topic[this.currenttextbox].start_date = this.picker;
     }
   },
   showDatePicker(index, current, type){
      this.picker = current;
      this.datepicker = true;
      this.currenttextbox = index;
      this.datetype = type;
   },
   removetopicdetail(topicdetail, index){
     this.$http.delete(this.$root.api + '/topicdetails/' + topicdetail.id).then((response) =>{
       this.topic.topicdetail.splice(index, 1);
     })
     .then((error)=>{

     })
   },
   updatetopic(){
      this.$http.put(this.$root.api + '/topics/'+ this.$route.params.id, {
        topic: this.topic.topic,
        descriptions: this.topic.descriptions
      }).then((response) =>{
        console.log(response);
        this.goRoute('/admin/topicedit/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },
    updatetopicdetail(id,index){
      this.$http.put(this.$root.api + '/topicsdetails/'+ id, {

        name: this.topic.topicdetail[index].name,
        description: this.topic.topicdetail[index].descriptions,
        date: this.topic.topicdetail[index].date,
        teacher: this.topic.topicdetail[index].teacher


      }).then((response) =>{
        console.log(response);
        // this.goRoute('/course/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },

    gettopic(){
      this.$http.get('http://localhost:8000/api/v1/topics/' + this.$route.params.id).then(response => {
       this.topic = response.body.data[0];
       console.log(this.topic);
      }, response =>{

      });
    }
  },
  created(){
   this.gettopic();
  }
}
</script>
