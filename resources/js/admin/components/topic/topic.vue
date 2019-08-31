<template>
  <v-row justify="center">
    <v-dialog persistent max-width="600px">
      <template v-slot:activator="{ on }">
          <v-container>
            <v-card class="mt-3" :elevation="5">
              <v-btn style="z-index:1" fixed fab bottom right color="accent" dark :elevation="8"><v-icon>add</v-icon></v-btn>
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
                <v-icon @click="showEditDialog(item)"
                  color="info">
                  edit
                </v-icon>
                <v-icon  @click="deleteTopic(item)"
                  color="error"
                  class="pl-2" >
                  delete
                </v-icon>
              </template>
            </v-data-table>
            </v-card>
          </v-container>
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
                        ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs12 sm12 md12 lg12 xl12>
                      Description
                      <v-textarea
                            outlined
                            label="Outlined textarea"
                      ></v-textarea>
                    </v-col>

                  </v-row>
                </v-flex>
          </v-layout>
          <v-layout>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text>Close</v-btn>
            <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
          </v-layout>
      </v-card>
    </v-dialog>
    <v-dialog v-model="editDialog" max-width="500px">
      <v-card
        ma-3
        :elevation="5"
        class="mx-auto"
        width="100%"
        style="border-radius:10px;"
      >
        <v-layout row ma-3>
          <v-flex xs12 sm12 md12 lg12 xl12 ml-12 mt-5>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Topic
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-text-field
                      filled
                      color="accent"
                      v-model = "selectedTopic.topic"
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
                      v-model = "selectedTopic.start_date"
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
                      v-model = "selectedTopic.end_date"
                    ></v-text-field>
                  </v-flex>
                </v-row>
              </v-flex>
              <v-layout row ma-3>
                <v-flex xs12 sm12 md12 lg12 xl12>
                  Description
                  <v-textarea
                    outlined
                    v-model = "selectedTopic.descriptions"
                  ></v-textarea>
                </v-flex>

              </v-layout>
        </v-layout>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="edit=false">close</v-btn>
          <v-btn
           @click="updateTopic" text>Update</v-btn>

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
        search:'',
        topics:[],
        editDialog:false,
        selectedTopic:{},
        headers: [
          {
            text: 'Name',
            align: 'left',
            sortable: false,
            value: 'topic',
          },
          { text: 'Start Date', value: 'start_date' },
          { text: 'End Date', value: 'end_date' },
          { text: 'Description', value: 'descriptions' },

          {
            text: 'Actions',
            value: 'action',
            align: 'right',
            sortable: false },
        ],
      }
    },
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      }
    },
    methods: {
      gettopics(){
        this.$http.get( this.$root.api + '/topics', {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          this.topics= response.body.data;
        }, response => {
          console.log('error');
        })
    },
    updateTopic(topic){
      this.$http.put(this.$root.api + '/topics/' + topic.id).then((response) =>{

      })
      .then((error)=>{

      })
    },
    showEditDialog(topic){
      var index = this.topics.indexOf(topic);
      this.selectedTopic = Object.assign({}, topic);
      this.editDialog = true;
    },
    deleteTopic(topic){
      var index = this.topics.indexOf(topic);
      this.$http.put(this.$root.api + '/topics/delete/'+ topic.id, {
        admin_id : this.Admin.id
      },
      {
        headers: {
          Authorization: 'Bearer ' + this.Admin.token
        }
      }).then((response) =>{
        this.topics.splice(index, 1);
      })
    }
  },
  created(){
    this.gettopics()
  }
}
</script>
