<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-layout>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
          <v-flex xs12 sm12 md10 lg10 xl10>
            <v-card class="mt-3">
              <v-card-title>
                Topics
                <v-spacer></v-spacer>
                <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
                <v-btn color="accent" dark v-on="on" :elevation="5"><v-icon>add</v-icon></v-btn>

              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="topics"
                :search="search"
              ><template v-slot:item.action="{ item }">

                <v-btn color="blue"
                @click="goRoute('/admin/topicedit/'+item.id)"
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
            </v-card>
          </v-flex>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
        </v-layout>

      </template>
      <v-card mx-height="100">
        <v-card-title>
          <span class="headline">Add Topic</span>
        </v-card-title>
          <v-layout row ma-3>

            <v-flex>
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

          <div class="button">
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
          </div>




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
