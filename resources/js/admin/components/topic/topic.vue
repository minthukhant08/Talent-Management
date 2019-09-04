<template>
  <v-row justify="center">
    <v-dialog v-model="addDialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
          <v-container>
            <v-card class="mt-3" :elevation="5">
              <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="addDialog=true" :elevation="8"><v-icon>mdi-playlist-plus</v-icon></v-btn>
              <v-card-title>
                Topics
                <v-spacer></v-spacer>
                <v-autocomplete
                class="ma-7"
                :items="courses"
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="id"
                label="Select Course"
                v-model="selected_course"
                @change="gettopics"
                >
                </v-autocomplete>
              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="topics"
              >
              <template v-slot:item.action="{ item }">
                <v-icon @click="showEditDialog(item)"
                  color="info">
                  mdi-square-edit-outline
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
                        v-model="editedTopic.topic"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Name
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-autocomplete
                      :items="courses"
                      clearable
                      hide-details
                      hide-selected
                      item-text="name"
                      item-value="id"
                      label="Select Course"
                      v-model="add_selected_course"
                      >
                      </v-autocomplete>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                       Start Date
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
                          v-model="editedTopic.start_date"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="editedTopic.start_date" @input="menu2 = false"></v-date-picker>
                      </v-menu>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      End Date
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
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
                          v-model="editedTopic.end_date"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="editedTopic.end_date" @input="menu = false"></v-date-picker>
                      </v-menu>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs12 sm12 md12 lg12 xl12>
                      Description
                      <v-textarea
                            outlined
                            v-model="editedTopic.descriptions"
                      ></v-textarea>
                    </v-col>

                  </v-row>
                </v-flex>
          </v-layout>
          <v-layout>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" @click="addDialog=false" text>Close</v-btn>
            <v-btn color="blue darken-1" text @click="saveTopic">Post</v-btn>
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

          <v-flex ma-5>
            <v-row>
              <v-flex xs12 sm12 md12 lg12 xl12 display-1 mb-7>
                Topic Edit
              </v-flex>

            </v-row>
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
                        v-model="selectedTopic.start_date"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="selectedTopic.start_date" @input="menu = false"></v-date-picker>
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
                        v-model="selectedTopic.end_date"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="selectedTopic.end_date" @input="menu2 = false"></v-date-picker>
                    </v-menu>
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
        selected_course:'',
        topics:[],
        courses:[],
        menu2:false,
        date:'',
        menu:false,
        editDialog:false,
        addDialog:false,
        selectedTopic:{},
        editedTopic:{},
        add_selected_course:'',
        headers: [
          {
            text: 'Name',
            align: 'left',
            sortable: false,
            value: 'topic',
            width:'150px'
          },
          { text: 'Start Date', value: 'start_date' , width:'120px'},
          { text: 'End Date', value: 'end_date', width:'120px'},
          { text: 'Description', value: 'descriptions' },

          {
            text: 'Actions',
            value: 'action',
            align: 'right',
            sortable: false,
            width: '120px'
          },
        ],
      }
    },
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      }
    },
    methods: {
      saveTopic(){
        this.$http.post(this.$root.api + '/topics',{
          admin_id : this.Admin.id,
          'topic' : this.editedTopic.topic,
          'start_date': this.editedTopic.start_date,
          'end_date' : this.editedTopic.end_date,
          'descriptions' : this.editedTopic.descriptions,
          'course_id' : this.add_selected_course
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.topics.unshift({
            'topic' : this.editedTopic.topic,
            'start_date': this.editedTopic.start_date,
            'end_date' : this.editedTopic.end_date,
            'descriptions' : this.editedTopic.descriptions
          })
          this.editDialog = false;
        })
        .then((error)=>{

        })
      },
      getCourse(){
          var results=[];
          this.$http.get(this.$root.api + '/courses/list',{
            headers: {
              Authorization: 'Bearer ' + this.Admin.token
            }
          }).then(response => {
            results = response.body.data;
            var i;
            for (i = 0; i < results.length; i++) {
              this.courses.push({name:results[i].name, id: results[i].id});
            }
        }, response => {

        });
      },
      gettopics(){
        this.$http.get( this.$root.api + '/topics/getbycourseid/' + this.selected_course, {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          this.topics= response.body.data;
        }, response => {
          console.log('error');
        })
    },
    updateTopic(){
      this.$http.put(this.$root.api + '/topics/' + this.selectedTopic.id,{
        admin_id : this.Admin.id,
        'topic' : this.selectedTopic.topic,
        'start_date': this.selectedTopic.start_date,
        'end_date' : this.selectedTopic.end_date,
        'descriptions' : this.selectedTopic.descriptions
      },
      {
        headers: {
          Authorization: 'Bearer ' + this.Admin.token
        }
      }).then((response) =>{
        this.topics.unshift({
          'topic' : this.selectedTopic.topic,
          'start_date': this.selectedTopic.start_date,
          'end_date' : this.selectedTopic.end_date,
          'descriptions' : this.selectedTopic.descriptions
        })
        this.editDialog = false;
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
    this.getCourse();
  }
}
</script>
