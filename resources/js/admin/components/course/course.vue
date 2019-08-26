<template>
  <v-card>
    <v-card-title>
      Course
      <v-spacer></v-spacer>
      <v-btn color="accent" @click="dialog2 = true"><v-icon>add </v-icon></v-btn>
    </v-card-title>
    <template>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
          <v-dialog v-model="dialog" max-width="500px">
            <v-card>
              <v-card-title>
                <span class="headline">Course Detail</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text>TimeTable</v-text>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text>Description</v-text>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="blue darken-1" @click="close()">Exit</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialog2" max-width="600px">
            <v-card>
              <v-card-title>
                <span class="headline">Add Course</span>
              </v-card-title>
                <v-layout>
                  <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
                  <v-flex xs0 sm0 md10 lg10 xl10>
                    <v-text-field
                    label="name"
                    color="accent"
                    mx-width="100%"></v-text-field>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" @click="close()">Cancel</v-btn>
                      <v-btn color="green" @click="save()">Post</v-btn>
                    </v-card-actions>
                  </v-flex>
                  <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
                </v-layout>

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
        <v-action >
        <v-btn color="blue"
        @click="goRoute('/admin/courseedit')"
          small
        >
          <v-icon>edit</v-icon>
        </v-btn>
        </v-action>
        <v-btn color="error"
        @click="deletedItem(item)"
          small
        ><v-icon>delete</v-icon>

        </v-btn>
      </template>

    </v-data-table>
  </template>

  </v-card>
</template>

<script>
import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data: () => ({
      dialog: false,
      dialog2: false,
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
      ],
  desserts:[],
    }),
    methods: {
      getCourses(){
        this.$http.get('http://localhost:8000/api/v1/courses').then(response=>{
          this.desserts= response.body.data;
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
      deletedItem(courses){
        const index = this.desserts.indexOf(courses)
        confirm('Are you sure you want to delete this item?'+courses) && this.desserts.splice(index, 1)
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
