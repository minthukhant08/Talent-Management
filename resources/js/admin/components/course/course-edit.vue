<template>
  <v-row>

          <v-layout row ma-3>

            <v-flex xs0 sm0 md2 lg2 xl2>
              <img src="" alt="">
            </v-flex>

            <v-flex xs12 sm12 md8 lg8 xl8>
            <v-layout row ma-3>
              <v-card ma5
              :elevation="5"
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
                            Name
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
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
                          Description
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.descriptions"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Start Date
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.start_date"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          End Date
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.end_date"
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
                :elevation="5"
                class="mx-auto mt-5"
                width="100%"
                style="border-radius:10px;"
                color="accent"
                v-for="(topic,index) in courses.topic"
                :key="index"
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
                            Topic
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.topic[index].topic"

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
                            descriptions
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                            v-model="courses.topic[index].descriptions"
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
                            Start Date
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                              v-model="courses.topic[index].start_date"
                              prepend-icon="event"
                              readonly
                              @click= "showDatePicker(index, courses.topic[index].start_date, 'start')"
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
                            End Date
                          </v-flex>
                          <v-flex xs4 sm4 md8 lg8 xl8>
                            <v-text-field
                              v-model="courses.topic[index].end_date"
                              prepend-icon="event"
                              readonly
                              @click= "showDatePicker(index,courses.topic[index].end_date, 'end')"
                            ></v-text-field>
                          </v-flex>

                        </v-layout>
                      </v-list-item>
                    </v-list-item-content>

                  </v-list-item>
                </v-list>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text @click="removetopic(topic, index)">Remove</v-btn>
                  <v-btn @click="updatetopic(topic.id, index)" text>Update</v-btn>
                </v-card-actions>
              </v-card>

                    <v-btn
                    class="ma-2"
                    outlined
                    color="accent"
                    >ADD<v-icon>add</v-icon></v-btn>
            </v-layout>
            </v-flex>

            <v-flex xs12 sm12 md2 lg2 xl2>

            </v-flex>

          </v-layout>
          <v-dialog v-model="datepicker" max-width="300">
            <v-date-picker v-model="picker" @change="changeDate()"></v-date-picker>
          </v-dialog>


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
        datepicker:false,
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
       this.courses.topic[this.currenttextbox].end_date = this.picker;
     }else{
       this.courses.topic[this.currenttextbox].start_date = this.picker;
     }
   },
   showDatePicker(index, current, type){
      this.picker = current;
      this.datepicker = true;
      this.currenttextbox = index;
      this.datetype = type;
   },
   removetopic(topic, index){
     this.$http.delete(this.$root.api + '/topics/' + topic.id).then((response) =>{
       this.courses.topic.splice(index, 1);
     })
     .then((error)=>{
     })
   },
   updatecourse(){
      this.$http.put(this.$root.api + '/courses/'+ this.$route.params.id, {
        name: this.courses.name,
        descriptions: this.courses.descriptions
      }).then((response) =>{
        console.log(response);
        this.goRoute('/admin/courseedit/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },
    updatetopic(id,index){
      this.$http.put(this.$root.api + '/topics/'+ id, {

        topic: this.courses.topic[index].topic,
        descriptions: this.courses.topic[index].descriptions,
        start_date: this.courses.topic[index].start_date,
        end_date: this.courses.topic[index].end_date


      }).then((response) =>{
        console.log(response);
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
