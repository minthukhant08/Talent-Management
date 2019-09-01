<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">

      <template v-slot:activator="{ on }">
        <!-- <v-layout>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
          <v-flex xs12 sm12 md10 lg10 xl10> -->
          <v-container>
            <v-card class="mt-3" :elevation="5">
              <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="dialog=true" :elevation="8"><v-icon>add</v-icon></v-btn>
              <v-card-title>
                Topics Details
                <v-spacer></v-spacer>
                <v-autocomplete
                class="ma-7"
                :items="topics"
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="id"
                label="Search for Courses"
                v-model="search"
                >
                </v-autocomplete>
                <v-autocomplete
                class="ma-7"
                :items="topics"
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="id"
                label="Search for Topic"
                v-model="search"
                >
                </v-autocomplete>
              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="topics"
                :search="search"
              >
              <template v-slot:item.action="{ item }">
                  <v-icon @click="edit=true"
                  color="info">edit</v-icon>
                <v-icon @click="deletedItem(item)" color="error" class="pl-2">delete</v-icon>


              </template>
            </v-data-table>
            </v-card>
          </v-container>
          <!-- </v-flex>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
        </v-layout> -->

      </template>
      <v-card mx-height="100">
        <v-card-title>
          <span class="headline">Add Topic</span>
        </v-card-title>
          <v-layout row ma-3>

            <v-flex ma-3>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Name
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="topics_name"
                      ></v-text-field>
                    </v-col>
                  </v-row>

                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                       Date
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
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
                          label="Picker without buttons"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                      </v-menu>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Teacher
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs12 sm12 md12 lg12 xl12>
                      Description
                      <v-textarea
                            outlined
                            label="Outlined textarea"
                            v-model="topics_descriptions"
                      ></v-textarea>
                    </v-col>

                  </v-row>
                </v-flex>
          </v-layout>
          <v-layout>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
          </v-layout>
      </v-card>
    </v-dialog>
    <v-dialog v-model="edit" max-width="500px">
      <v-card
        ma-3
        :elevation="5"
        class="mx-auto"
        width="100%"
        style="border-radius:10px;"
      >
        <v-layout row ma-3>
          <v-flex xs12 sm12 md12 lg12 xl12 ml-7 mt-5>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Name
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-text-field
                      filled
                      color="accent"
                    ></v-text-field>
                  </v-flex>
                </v-row>

                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                  Date
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
                        label="Picker without buttons"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                    </v-menu>
                  </v-flex>
                </v-row>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Teacher
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-autocomplete
                      label="Components"
                      :items="components"
                    ></v-autocomplete>
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
  </v-row>
</template>
<script>
import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data: () => ({
        components: [
          'name', 'image',
        ],
      date: new Date().toISOString().substr(0, 10),
      menu: false,
      menu2: false,
      dialog: false,
      dialog2: false,
      topics:[],
      edit: false,
      search:'',
      topics_name:'',
      topics_start_date:'',
      topics_end_date:'',
      topics_descriptions:'',
      headers: [
        {
          text: 'Name',
          align: 'left',
          sortable: false,
          value: 'name',
        },
        { text: 'Description', value: 'descriptions'},
        { text: 'Date', value: 'date'},
        {
          text: 'Actions',
          value: 'action',
          align: 'right',
          sortable: false },
      ],
  desserts:[],
    }),
    methods: {
      gettopic(){
        this.$http.get('http://localhost:8000/api/v1/topicdetails').then(response=>{
          this.topics= response.body.data;
        }, response => {
          console.log('error');
        })
      },
      deletedItem(topics){
        const index = this.topics.indexOf(topics)
        this.desserts.splice(index, 1)
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
      this.gettopic()
    }
  }
</script>
