<template>
  <v-layout>
    <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
    <v-flex xs12 sm12 md10 lg10 xl10>
      <v-card>
        <v-card-title>
          Topic
          <v-spacer></v-spacer>
          <v-btn color="accent"><v-icon>add </v-icon></v-btn>
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
                    <span class="headline">Topic Detail</span>
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

          </template>
          <template v-slot:item.action="{ item }">

            <v-action >
            <v-btn color="blue"
            @click="goRoute('/admin/topicedit')"
              small
            >
              <v-icon>edit</v-icon>
            </v-btn>
            </v-action>
            <v-btn color="error"
            @click="close()"
              small
            ><v-icon>delete</v-icon>

            </v-btn>
          </template>

        </v-data-table>
      </template>

      </v-card>
    </v-flex>
    <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
  </v-layout>

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
          text: 'Name',
          align: 'left',
          sortable: false,
          value: 'topic',
        },
        { text: 'Description', value: 'descriptions',width: '600px' },

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
        this.$http.get('http://localhost:8000/api/v1/topics/1').then(response=>{
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
