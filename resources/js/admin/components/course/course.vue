<template>
<v-layout row ma-3>

  <v-flex xs0 sm0 md1 lg1 xl1>

  </v-flex>

  <v-flex xs12 sm12 md10 lg10 xl10>

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
        <v-btn color="accent" @click="dialog2 = true" :elevation="5"><v-icon>add </v-icon></v-btn>
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
                    <v-flex xs12 sm12 md5 lg5 xl5>
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
                    <v-flex xs12 sm12 md7 lg7 xl7>
                          <v-row class="customActivityForm">
                            <v-col xs12 sm12 md2 lg2 xl2>
                              Name
                            </v-col>
                            <v-col xs12 sm12 md10 lg10 xl10>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="courses_name"
                              ></v-text-field>
                            </v-col>
                          </v-row>

                          <v-row class="customActivityForm">
                            <v-col xs12 sm12 md3 lg3 xl3>
                              Start Date
                            </v-col>
                            <v-col xs12 sm12 md7 lg7 xl7>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="courses_start_date"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          <v-row class="customActivityForm">
                            <v-col xs12 sm12 md3 lg3 xl3>
                              End Date
                            </v-col>
                            <v-col xs12 sm12 md7 lg7 xl7>
                              <v-text-field
                                filled
                                color="accent"
                                v-model="courses_end_date"
                                ></v-text-field>
                            </v-col>
                          </v-row>
                          <v-row>
                            <v-col xs12 sm12 md3 lg3 xl3>
                              Description
                            </v-col>
                            </v-col>
                          </v-row>
                          <v-row>
                            <v-col xs12 sm12 md12 lg12 xl12>
                              <v-textarea
                                filled
                                color="accent"
                                v-model="courses_descriptions"
                              ></v-textarea>
                            </v-col>
                          </v-row>
                        </v-flex>
                  </v-layout>

                  <div class="button">
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
                  </div>
              </v-card>
            </v-dialog>

        </template>
        <template v-slot:item.image="{ item }">
          <v-avatar>
            <img :src="item.image" alt="course image">
          </v-avatar>
        </template>
        <template v-slot:item.action="{ item }">
          <v-btn
            color="green"
            small
            @click="dialog=true"
          >
            <v-icon>short_text</v-icon>
          </v-btn>
          <v-btn color="blue"
                              @click="goRoute('/admin/courseedit/'+ item.id)"
            small
          >
            <v-icon>edit</v-icon>
          </v-btn>
          <v-btn color="error"
          @click="deletedItem(item)"
            small
          ><v-icon>delete</v-icon>

          </v-btn>
        </template>

      </v-data-table>
    </template>

    </v-card>

  </v-flex>

  <v-flex xs12 sm12 md1 lg1 xl1>

  </v-flex>

</v-layout>

</template>

<script>
import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data: () => ({
      search: '',
      dialog: false,
      dialog2: false,
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
      putCourses(){
        this.$http.put('http://localhost:8000/api/v1/courses',{name}).then(response=>{
          this.desserts= response.body.data;
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
      deletedItem(courses){
        const index = this.desserts.indexOf(courses)
        confirm('Are you sure you want to delete this item?'+courses) && this.desserts.splice(index, 1)
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
