<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">

      <template v-slot:activator="{ on }">
          <v-container>
            <v-card class="mt-3" :elevation="5">
              <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="dialog=true" :elevation="8"><v-icon>mdi-playlist-plus</v-icon></v-btn>
              <v-card-title>
                Topics Details
                <v-spacer></v-spacer>
                <v-autocomplete
                :items="courses"
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="id"
                label="Select Course"
                v-model="selected_course"
                @change="gettopic"
                >
                </v-autocomplete>
                <v-autocomplete
                class="pl-2"
                :items="topics"
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="id"
                label="Topic"
                v-model="selected_topic"
                @change="gettopicdetails"
                >
                </v-autocomplete>
              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="topicdetails"
              >
              <template v-slot:item.action="{ item }">
                  <v-icon @click="editTopicDetail(item)"
                  color="info">mdi-square-edit-outline</v-icon>
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
          <span class="headline">Add Topic Detail</span>
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
                        v-model="editedtopic.name"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Topic
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-autocomplete
                        :items = 'addtopics'
                        item-value ="id"
                        item-text = "topic"
                        color="accent"
                        v-model="editedtopic.topic_id"
                      ></v-autocomplete>
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
                          v-model="editedtopic.date"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="editedtopic.date" @input="menu2 = false"></v-date-picker>
                      </v-menu>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Teacher
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-autocomplete
                        :items="teachers"
                        item-text="name"
                        item-value="id"
                        v-model="editedtopic.teacher_id"
                      ></v-autocomplete>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs12 sm12 md12 lg12 xl12>
                      Description
                      <v-textarea
                        outlined
                        v-model="editedtopic.descriptions"
                      ></v-textarea>
                    </v-col>

                  </v-row>
                </v-flex>
          </v-layout>
          <v-layout>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="post">Post</v-btn>
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
                      v-model="selectedtopic.name"
                    ></v-text-field>
                  </v-flex>
                </v-row>

                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                  Date
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-menu
                    v-model="menu3"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                        v-model="selectedtopic.date"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="selectedtopic.date" @input="menu3 = false"></v-date-picker>
                    </v-menu>
                  </v-flex>
                </v-row>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Teacher
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-autocomplete
                      :items="teachers"
                      item-text="name"
                      item-value="id"
                      v-model = "selectedtopic.teacher_id"
                    ></v-autocomplete>
                  </v-flex>
                </v-row>
              </v-flex>
              <v-layout row ma-3>
                <v-flex xs12 sm12 md12 lg12 xl12>
                  Description
                  <v-textarea
                        outlined
                        v-model="selectedtopic.descriptions"
                  ></v-textarea>
                </v-flex>

              </v-layout>
        </v-layout>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="edit = false">close</v-btn>
          <v-btn
          text
          @click="updatetopicdetail"
          >Update</v-btn>

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
      selected_teacher:'',
      addtopics:[],
      teachers:[],
      date: new Date().toISOString().substr(0, 10),
      courses:[],
      topicdetails:[],
      selected_course:'',
      selected_topic:'',
      menu: false,
      menu2: false,
      menu3:false,
      menu4: false,
      dialog: false,
      dialog2: false,
      topics:[],
      edit: false,
      selectedtopic:{},
      editedtopic:{},
      teachers:[],
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
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      }
    },
    methods: {
      updatetopicdetail(){
        this.$http.put(this.$root.api + '/topicdetails/' + this.selectedtopic.id,{
          admin_id : this.Admin.id,
          'name' : this.selectedtopic.name,
          'date': this.selectedtopic.date,
          'descriptions' : this.selectedtopic.descriptions,
          'teacher_id'  : this.selectedtopic.teacher_id
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.topics.unshift({
            'name' : this.selectedtopic.name,
            'date': this.selectedtopic.date,
            'descriptions' : this.selectedtopic.descriptions,
            'teacher_id'  : this.selectedtopic.teacher_id
          })
          this.edit = false;
        })
        .then((error)=>{

        })
      },
      editTopicDetail(item){
        this.selectedtopic= item;
        this.selectedtopic.teacher_id = item.teacher.id
        console.log(this.selectedtopic.teacher_id);
        this.edit = true;
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
      getteachers(){
          var results=[];
          this.$http.get(this.$root.api + '/users?type=teacher',{
            headers: {
              Authorization: 'Bearer ' + this.Admin.token
            }
          }).then(response => {
            results = response.body.data;
            var i;
            for (i = 0; i < results.length; i++) {
              this.teachers.push({name:results[i].name, id: results[i].id});
            }
        }, response => {

        });
      },
      gettopic(){
        var res=[];
        this.$http.get(this.$root.api + '/topics/list/' + this.selected_course,{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          res = response.body.data;
          console.log(res);
          this.topics=[];
          var i;
          for (i = 0; i < res.length; i++) {
            this.topics.push({name:res[i].topic, id: res[i].id});
          }
        }, response => {
          console.log('error');
        })
      },
      gettopicforadd(){
        var res=[];
        this.$http.get(this.$root.api + '/topics',{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          res = response.body.data;
          this.addtopics=[];
          var i;
          for (i = 0; i < res.length; i++) {
            this.addtopics.push({topic:res[i].topic, id: res[i].id});
          }
          console.log(this.addtopics);
        }, response => {
          console.log('error');
        })
      },
      gettopicdetails(){
        this.$http.get(this.$root.api + '/topicdetails/getbytopicid/' + this.selected_topic,{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          this.topicdetails = response.body.data;
          console.log(this.topicdetails);
        }, response => {
          console.log('error');
        })
      },
      post(){
        console.log("topic id is " + this.editedtopic.topic_id);
        this.$http.post(this.$root.api + '/topicdetails',{
          'name' : this.editedtopic.name,
          'date': this.editedtopic.date,
          'teacher_id' : this.editedtopic.teacher_id,
          'descriptions' : this.editedtopic.descriptions,
          'admin_id' : this.Admin.id,
          'topic_id' :this.editedtopic.topic_id
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          console.log(response.body);
          this.topics.unshift({
            'name' : this.editedtopic.name,
            'date': this.editedtopic.date,
            'teacher_id' : this.editedtopic.teacher_id,
            'descriptions' : this.editedtopic.descriptions,
            'topic_id' :this.editedtopic.topic_id
          })
          this.dialog = false;
        }, response => {
          console.log('error');
        })
      },
      deletedItem(topics){
        const index = this.topicdetails.indexOf(topics)
        this.topicdetails.splice(index, 1)
      }
    },

    created(){
      this.gettopicforadd();
      this.getCourse();
      this.getteachers();
    }
  }
</script>
