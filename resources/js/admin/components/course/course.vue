<template>
  <v-container>
    <v-card class="mt-3" :elevation="5">
      <v-card-title>
        Course
        <v-spacer></v-spacer>
        <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
        <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="dialog2=true" :elevation="8"><v-icon>add</v-icon></v-btn>
      </v-card-title>
      <template>
      <v-data-table
        :headers="headers"
        :items="courses"
        sort-by="calories"
        class="elevation-1"
        :search="search"
      >
        <template v-slot:top>
            <v-dialog v-model="dialog" max-width="500px">
              <v-card>
                <v-card-title>
                  <span class="headline">Course Detail</span>
                </v-card-title>

                <v-card>
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        TimeTable
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        Description
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col xs12 sm12 md12 lg12 xl12>
                        <v-btn style="float:right;"color="blue darken-1" @click="close()">Exit</v-btn>
                      </v-col>
                    </v-row>

                  </v-container>
                </v-card>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialog2" max-width="600px">
              <v-card mx-height="100">
                <v-card-title>
                  <span class="headline">Add Course</span>
                </v-card-title>
                  <v-layout row ma-3>
                    <v-flex xs12 sm12 md4 lg4 xl4>
                      <v-col align="center" justify="center">
                        <v-img
                          src="https://picsum.photos/id/11/500/300"
                          lazy-src="https://picsum.photos/id/11/10/6"
                          aspect-ratio="1"
                          class="grey lighten-2"
                          max-width="200"
                          max-height="200"
                        ><v-icon>camera</v-icon></v-img>
                    </v-col>
                    </v-flex>
                    <v-flex xs12 sm12 md7 lg7 xl7 ml-7>
                          <v-row class="customActivityForm">
                            <v-flex xs12 sm12 md3 lg3 xl3>
                              Name
                            </v-flex>
                            <v-flex xs12 sm12 md7 lg7 xl7>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="activities_name"
                              ></v-text-field>
                            </v-flex>
                          </v-row>
                          <v-row class="customActivityForm">
                            <v-flex xs12 sm12 md3 lg3 xl3>
                               Start Date
                            </v-flex>
                            <v-flex xs12 sm12 md7 lg7 xl7>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="activities_date"
                              ></v-text-field>
                            </v-flex>
                          </v-row>
                          <v-row class="customActivityForm">
                            <v-flex xs12 sm12 md3 lg3 xl3>
                              End Date
                            </v-flex>
                            <v-flex xs12 sm12 md7 lg7 xl7>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="activities_date"
                              ></v-text-field>
                            </v-flex>
                          </v-row>
                        </v-flex>
                        <v-layout row ma-3>
                          <v-flex xs12 sm12 md12 lg12 xl12>
                            Description
                            <v-textarea
                                  outlined
                                  label="Outlined textarea"
                                  v-model="activities_descriptions"
                            ></v-textarea>
                          </v-flex>

                        </v-layout>
                  </v-layout>

                  <v-layout>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog2 = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
                  </v-layout>
              </v-card>
            </v-dialog>
            <v-dialog v-model="edit" max-width="500px">
              <v-card ma5
              :elevation="5"
                class="mx-auto"
                width="100%"
                style="border-radius:10px;"
              >
                <v-layout row ma-3>
                  <v-flex xs12 sm12 md4 lg4 xl4>
                    <v-col align="center" justify="center">
                      <v-img
                        src="https://picsum.photos/id/11/500/300"
                        lazy-src="https://picsum.photos/id/11/10/6"
                        aspect-ratio="1"
                        class="grey lighten-2"
                        max-width="200"
                        max-height="200"
                      ><v-icon>camera</v-icon></v-img>
                  </v-col>
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7 ml-7 mt-5>
                        <v-row class="customActivityForm">
                          <v-flex xs12 sm12 md3 lg3 xl3>
                            Name
                          </v-flex>
                          <v-flex xs12 sm12 md7 lg7 xl7>
                            <v-text-field
                              filled
                              color="accent"
                              v-model="activities_name"
                            ></v-text-field>
                          </v-flex>
                        </v-row>
                        <v-row class="customActivityForm">
                          <v-flex xs12 sm12 md3 lg3 xl3>
                             Start Date
                          </v-flex>
                          <v-flex xs12 sm12 md7 lg7 xl7>
                            <v-text-field
                              filled
                              color="accent"
                              v-model="activities_date"
                            ></v-text-field>
                          </v-flex>
                        </v-row>
                        <v-row class="customActivityForm">
                          <v-flex xs12 sm12 md3 lg3 xl3>
                            End Date
                          </v-flex>
                          <v-flex xs12 sm12 md7 lg7 xl7>
                            <v-text-field
                              filled
                              color="accent"
                              v-model="activities_date"
                            ></v-text-field>
                          </v-flex>
                        </v-row>
                      </v-flex>
                      <v-layout row ma-3>
                        <v-flex xs12 sm12 md12 lg12 xl12>
                          Description
                          <v-textarea
                                outlined
                                label="Outlined textarea"
                                v-model="activities_descriptions"
                          ></v-textarea>
                        </v-flex>

                      </v-layout>
                </v-layout>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text @click="edit=false">close</v-btn>
                  <v-btn
                   @click="updatecourse" text>Update</v-btn>

                </v-card-actions>
              </v-card>
            </v-dialog>

        </template>
        <template v-slot:item.image="{ item }">
          <v-avatar>
            <img :src="item.image" alt="course image">
          </v-avatar>
        </template>
        <template v-slot:item.action="{ item }">
          <v-icon @click="dialog=true" color="green">short_text</v-icon>
          <v-icon @click="edit=true" color="info" class="pl-2">edit</v-icon>
          <v-icon @click="deleteItem(item)" color="error" class="pl-2">delete</v-icon>
        </template>

      </v-data-table>
    </template>

    </v-card>
</v-container>
</template>
<script>
import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data: () => ({
      datepicker:false,
      picker:'',
      currenttextbox:'',
      datetype:'',
      search: '',
      dialog: false,
      dialog2: false,
      edit: false,
      courses_name:'',
      courses_descriptions:'',
      courses_start_date:'',
      courses_end_date:'',
      courses:[],
      headers: [
      {
        text: 'Image',
        align: 'left',
        sortable: false,
        value: 'image',
      },

        { text: 'Name', value: 'name' },
        { text: ' Start Date', value: 'start_date' },
        { text: 'End Date', value: 'end_date' },
        {
          text: 'Actions',
          value: 'action',
          align: 'right',
          sortable: false },
      ]
    }),
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
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
      getCourses(){
        this.$http.get('http://localhost:8000/api/v1/courses',{
          headers: {
              Authorization: 'Bearer '+ this.User.token
          }
        }).then(response=>{
          this.courses= response.body.data;
          console.log(this.desserts);
        }, response => {
          console.log('error');
        })
      },

      save(){
        this.$http.post(this.$root.api+'/activities',{
          "name": this.courses_name,
          "descriptions":this.courses_descriptions,
          "start_date": this.courses_start_date,
          "end_date": this.courses_end_date,

        }).then((response)=>{
          this.activities.unshift({
            "name": this.courses_name,
            "descriptions":this.courses_descriptions,
            "start_date": this.courses_start_date,
            "end_date": this.courses_end_date,});
          this.dialog = false;
        })
        .then((error) =>{

        })
      },
      deleteItem (item) {
        const index = this.courses.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.courses.splice(index, 1)
      },
      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
      close() {
        this.dialog = false
        setTimeout(()=>{
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        },300)
      }
    },

    created(){
      this.getCourses()
    }

  }
</script>
