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
        <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="dialog2=true" :elevation="8"><v-icon>mdi-playlist-plus</v-icon></v-btn>
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
            <v-dialog v-model="dialog2" max-width="600px">
              <v-card mx-height="100">
                <v-card-title>
                  <span class="headline">Add Course</span>
                </v-card-title>
                  <v-layout row ma-3>
                    <v-flex xs12 sm12 md4 lg4 xl4>
                      <v-col align="center" justify="center">
                        <v-img
                          :src="selectedCourse.image"
                          aspect-ratio="1"
                          class="grey lighten-2"
                          max-width="200"
                          max-height="200"
                        ><v-icon style="float:right;" @click="selectImage">camera</v-icon></v-img>
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
                                v-model="selectedCourse.name"
                              ></v-text-field>
                            </v-flex>
                          </v-row>
                          <v-row class="customActivityForm">
                            <v-flex xs12 sm12 md3 lg3 xl3>
                               Start Date
                            </v-flex>
                            <v-flex xs12 sm12 md7 lg7 xl7>
                              <v-menu
                              v-model="menu"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              transition="scale-transition"
                              offset-y
                              full-width
                              min-width="290px"
                              >
                                <template v-slot:activator="{ on }">
                                  <v-text-field
                                  v-model="selectedCourse.start_date"
                                  prepend-icon="event"
                                  readonly
                                  v-on="on"
                                  ></v-text-field>
                                </template>
                                <v-date-picker v-model="selectedCourse.start_date" @input="menu = false"></v-date-picker>
                              </v-menu>
                            </v-flex>
                          </v-row>
                          <v-row class="customActivityForm">
                            <v-flex xs12 sm12 md3 lg3 xl3>
                              End Date
                            </v-flex>
                            <v-flex xs12 sm12 md7 lg7 xl7>
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
                                  <v-text-field
                                  v-model="selectedCourse.end_date"
                                  prepend-icon="event"
                                  readonly
                                  v-on="on"
                                  ></v-text-field>
                                </template>
                                <v-date-picker v-model="selectedCourse.end_date" @input="menu2 = false"></v-date-picker>
                              </v-menu>
                            </v-flex>
                          </v-row>
                        </v-flex>
                        <v-layout row ma-3>
                          <v-flex xs12 sm12 md12 lg12 xl12>
                            Description
                            <v-textarea
                                outlined
                                v-model="selectedCourse.descriptions"
                            ></v-textarea>
                          </v-flex>

                        </v-layout>
                  </v-layout>
                    <v-divider></v-divider>
                  <v-card-actions>

                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog2 = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="postCourse()">Post</v-btn>
                  </v-card-actions>
              </v-card>
            </v-dialog>
            <input type="file" accept="image/*" style="display: none;" ref="user_bg" id="user_bg" @change="setImage" />
            <v-dialog v-model="editDialog" max-width="500px">
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
                        :src="selectedCourse.image"
                        aspect-ratio="1"
                        class="grey lighten-2"
                        max-width="200"
                        max-height="200"
                      ><v-icon style="float:right;" @click="selectImage">camera</v-icon></v-img>

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
                              v-model="selectedCourse.name"
                            ></v-text-field>
                          </v-flex>
                        </v-row>
                        <v-row class="customActivityForm">
                          <v-flex xs12 sm12 md3 lg3 xl3>
                             Start Date
                          </v-flex>
                          <v-flex xs12 sm12 md7 lg7 xl7>
                            <v-menu
                            v-model="menu"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                            >
                              <template v-slot:activator="{ on }">
                                <v-text-field
                                v-model="date"
                                prepend-icon="event"
                                readonly
                                v-on="on"
                                ></v-text-field>
                              </template>
                              <v-date-picker v-model="date" @input="menu = false"></v-date-picker>
                            </v-menu>
                          </v-flex>
                        </v-row>
                        <v-row class="customActivityForm">
                          <v-flex xs12 sm12 md3 lg3 xl3>
                            End Date
                          </v-flex>
                          <v-flex xs12 sm12 md7 lg7 xl7>
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
                                <v-text-field
                                v-model="date"
                                prepend-icon="event"
                                readonly
                                v-on="on"
                                ></v-text-field>
                              </template>
                              <v-date-picker v-model="date" @input="menu = false"></v-date-picker>
                            </v-menu>
                          </v-flex>
                        </v-row>
                      </v-flex>
                      <v-layout row ma-3>
                        <v-flex xs12 sm12 md12 lg12 xl12>
                          Description
                          <v-textarea
                            outlined
                            v-model="selectedCourse.descriptions"
                          ></v-textarea>
                        </v-flex>

                      </v-layout>
                </v-layout>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text @click="edit=false">close</v-btn>
                  <v-btn
                   @click="updateCourse" text>Update</v-btn>

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
          <v-icon @click="showEditDialog(item)" color="info" class="pl-2">mdi-square-edit-outline</v-icon>
          <v-icon @click="deleteCourse(item)" color="error" class="pl-2">delete</v-icon>
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
    data(){
      return{
        search:'',
        menu:false,
        menu2:false,
        dialog2:false,
        date:new Date().toISOString().substr(0, 10),
        selectedCourse:{},
        createDialog:false,
        editDialog:false,
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

      }
    },
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      }
    },
    methods:{
      selectImage(){
        console.log('select image');
        console.log(this.$refs);
        this.$refs.user_bg.click();
      },
      setImage(){
        this.selectedCourse.image=URL.createObjectURL(this.$refs.user_bg.files[0]);
        console.log(this.selectedCourse.image);
      },
      getCourses(){
        this.$http.get(this.$root.api + '/courses',{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.courses = response.body.data;
        })
        .then((error)=>{

        })
      },
      postCourse(){
        console.log( this.$refs.user_bg.files[0]);
        this.$http.post(this.$root.api + '/courses',{
          admin_id: this.Admin.id,
          name: this.selectedCourse.name,
          start_date: this.selectedCourse.start_date,
          end_date: this.selectedCourse.end_date,
          image: this.$refs.user_bg.files[0]
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{

        })
        .then((error)=>{

        })
      },
      updateCourse(course){
        this.$http.put(this.$root.api + '/courses/' + course.id).then((response) =>{

        })
        .then((error)=>{

        })
      },
      showEditDialog(course){
        var index = this.courses.indexOf(course);
        this.selectedCourse = course;
        this.editDialog = true;
      },
      deleteCourse(course){
        var index = this.courses.indexOf(course);
        this.$http.put(this.$root.api + '/courses/delete/'+ course.id, {
          admin_id : this.Admin.id
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.courses.splice(index, 1);
        })
      }

    },
    created(){
      this.getCourses();
    }
  }
</script>
