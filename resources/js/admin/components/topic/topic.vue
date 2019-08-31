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
                Topics
                <v-spacer></v-spacer>
                <v-autocomplete
                class="ma-7"
                :items="topics"
                clearable
                hide-details
                hide-selected
                item-text="topic"
                item-value="id"
                label="Search for Course's Topic"
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
                       Start Date
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="topics_start_date"
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
                        v-model="topics_end_date"
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
                    Topic
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
  </v-row>
</template>

<script>
import commonmethods from '../../mixins/commonMethods';
  export default {
    mixins:[commonmethods],
    data: () => ({
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
      gettopic(){
        this.$http.get('http://localhost:8000/api/v1/topics').then(response=>{
          this.topics= response.body.data;
        }, response => {
          console.log('error');
        })
      },
      deletedItem(topics){
        const index = this.topics.indexOf(topics)
        this.desserts.splice(index, 1)
      },
      save(){
        this.$http.post(this.$root.api+'/activities',{
          "topic": this.topics_name,
          "start_date": this.topics_start_date,
          "end_date": this.topics_end_date,
          "descriptions":this.topics_descriptions
        }).then((response)=>{
          this.activities.unshift({
            "topic": this.topics_name,
            "start_date": this.topics_start_date,
            "end_date": this.topics_end_date,
            "descriptions":this.topics_descriptions});
          this.dialog = false;
        })
        .then((error) =>{

        })
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
