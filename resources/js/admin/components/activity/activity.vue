<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-layout>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
          <v-flex xs12 sm12 md10 lg10 xl10>
            <v-card class="mt-3">
              <v-card-title>
                Activity
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
                :items="activities"
                :search="search"
              ><template v-slot:item.action="{ item }">

                <v-btn color="blue"
                @click="goRoute('/admin/activityedit/'+item.id)"
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
          <span class="headline">Add Activity</span>
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
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Name
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="activities_name"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Speaker
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="activities_speaker"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Date
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="activities_date"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Type
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-autocomplete
                        :items="components"
                      ></v-autocomplete>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs12 sm12 md12 lg12 xl12>
                      Description
                      <v-textarea
                            outlined
                            label="Outlined textarea"
                            v-model="activities_descriptions"
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
      activities:[],
      search:'',
      components:['post','Annoucment'],
      headers: [
        {
          text: 'Name',
          align: 'left',
          sortable: false,
          value: 'name',
        },
        { text: 'Date', value: 'date' },
        { text: 'Speaker Name', value: 'speaker' },
        {
          text: 'Actions',
          value: 'action',
          align: 'right',
          sortable: false },
      ],
  desserts:[],
  activities_name:'',
  activities_speaker:'',
  activities_date:'',
  activities_type:'',
  activities_descriptions:''
    }),
    methods: {
      getactivity(){
        this.$http.get('http://localhost:8000/api/v1/activities').then(response=>{
          this.activities= response.body.data;
        }, response => {
          console.log('error');
        })
      },
      putactivity(){
        this.$http.put('http://localhost:8000/api/v1/activities',{name}).then(response=>{
          this.activities= response.body.data;
        }, response => {
          console.log('error');
        })
      },
      deletedItem(activity){
        const index = this.activities.indexOf(activity)
        this.desserts.splice(index, 1)
      },
      save(){
        this.$http.post(this.$root.api+'/activities',{
          "name": this.activities_name,
          "speaker_name": this.activities_speaker,
          "date": this.activities_date,
          "type": this.activities_type,
          "descriptions":this.activities_descriptions
        }).then((response)=>{
          this.activities.unshift({"name": this.activities_name,
          "speaker": this.activities_speaker,
          "date": this.activities_date,
          "type": this.activities_type,
          "descriptions":this.activities_descriptions});
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
      this.getactivity()
    }
  }
</script>
<style lang="sass">
  .customActivityForm.row
    height: 55px
    .col
        height: 55px
    .v-text-field
      padding-top: 0
      margin-top: 0
    .v-text-field--filled>.v-input__control>.v-input__slot
      max-height: 30px !important
      min-height: 0 !important

    .v-text-field--filled input
      margin-top: 0

</style>
