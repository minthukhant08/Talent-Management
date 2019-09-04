<template>
  <v-row justify="center">
      <input type="file" accept="image/*" style="display: none;" ref="activity_img" id="activity_img" @change="setImage" />
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-container>
            <v-card class="mt-3">
              <v-card-title>
                Activity
                <v-spacer></v-spacer>
              <v-select
               class="px-2"
               width="100"
               v-model="selectedType"
               :items="['Post', 'Announcement']"
               label="Type"
               hide-details
               @change="getactivity"
              ></v-select>
              <v-text-field
              v-model="search"
              append-icon="search"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
                <v-btn style="z-index:1" fixed fab bottom right color="accent" dark @click="dialog=true" :elevation="8"><v-icon>mdi-playlist-plus</v-icon></v-btn>

              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="activities"
                :search="search"
              ><template v-slot:item.action="{ item }">
                  <v-icon @click="showEditDialog(item)" color="info">mdi-square-edit-outline</v-icon>
                  <v-icon @click="deleteActivity(item)" color="error" class="pl-2">delete</v-icon>
              </template>
            </v-data-table>
            </v-card>
          </v-container>

      </template>
      <v-card mx-height="100">
        <v-card-title>
          <span class="headline">Add Activity</span>
        </v-card-title>
          <v-layout row ma-3>
            <v-flex xs12 sm12 md4 lg4 xl4>
              <v-col align="center" justify="center">
                <v-img
                  :src="editedActivity.image"
                  aspect-ratio="1"
                  class="grey lighten-2"
                  max-width="200"
                  max-height="200"
                ><v-icon style="float:right;" @click="selectImage">camera</v-icon></v-img>
            </v-col>
            </v-flex>
            <v-flex xs12 sm12 md7 lg7 xl7 ml-7>
                  <v-row class="customActivityForm">
                    <v-flex xs12 sm12 md3 lg3 xl3>
                      Name
                    </v-flex>
                    <v-flex xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="editedActivity.name"
                      ></v-text-field>
                    </v-flex>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-flex xs12 sm12 md3 lg3 xl3>
                      Speaker
                    </v-flex>
                    <v-flex xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        v-model="editedActivity.speaker_name"
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
                          v-model="editedActivity.date"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="editedActivity.date" @input="menu = false"></v-date-picker>
                      </v-menu>
                    </v-flex>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-flex xs12 sm12 md3 lg3 xl3>
                      Type
                    </v-flex>
                    <v-flex xs12 sm12 md7 lg7 xl7>
                      <v-autocomplete
                        :items="components"
                         item-text="type"
                         item-value="type"
                        v-model="editedActivity.type"
                      ></v-autocomplete>
                    </v-flex>
                  </v-row>
                </v-flex>
                <v-layout row ma-3>
                  <v-flex xs12 sm12 md12 lg12 xl12>
                    Description
                    <v-textarea
                          outlined
                          v-model="editedActivity.descriptions"
                    ></v-textarea>
                  </v-flex>

                </v-layout>
          </v-layout>
          <div class="button">
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="save()">Post</v-btn>
          </div>
      </v-card>
    </v-dialog>
    <v-dialog v-model="edit" max-width="650px">
      <v-card ma5
        class="mx-auto"
        width="100%"

      >
        <v-layout row ma-3>
          <v-flex xs12 sm12 md12 lg12 xl12>
            <v-col align="center" justify="center">
              <v-img
                :src="selectedActivity.image"
                :aspect-ratio="16/9"
                class="grey lighten-2"
              ><v-icon style="float:right;" @click="selectImage">camera</v-icon></v-img>
          </v-col>
          </v-flex>
          <v-flex xs12 sm12 md12 lg12 xl12 ml-12 mt-5>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Name
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-text-field
                      filled
                      color="accent"
                      v-model="selectedActivity.name"
                    ></v-text-field>
                  </v-flex>
                </v-row>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                     Speaker
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-text-field
                      filled
                      color="accent"
                      v-model="selectedActivity.speaker"
                    ></v-text-field>
                  </v-flex>
                </v-row>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                    Date
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
                          v-model="selectedActivity.date"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="selectedActivity.date" @input="menu = false"></v-date-picker>
                    </v-menu>
                  </v-flex>
                </v-row>
                <v-row class="customActivityForm">
                  <v-flex xs12 sm12 md3 lg3 xl3>
                     Type
                  </v-flex>
                  <v-flex xs12 sm12 md7 lg7 xl7>
                    <v-autocomplete
                      :items="['post', 'announcement']"
                      v-model='selectedActivity.type'
                    ></v-autocomplete>
                  </v-flex>
                </v-row>
              </v-flex>
              <v-layout row ma-3>
                <v-flex xs12 sm12 md12 lg12 xl12>
                  Description
                  <v-textarea
                        outlined
                          v-model="selectedActivity.descriptions"
                  ></v-textarea>
                </v-flex>

              </v-layout>
        </v-layout>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="edit=false">close</v-btn>
          <v-btn
            text
            @click="updateActivity"
            >
            Update
          </v-btn>

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
      date: new Date().toISOString().substr(0, 10),
      selectedActivity:{},
      editedActivity:{},
      selectedType:'Post',
      menu: false,
      menu2:false,
      edit:false,
      dialog: false,
      dialog2: false,
      activities:[],
      search:'',
      components:[{type:'Post'},{type:'Annoucment'}],
      headers: [
        {
          text: 'Name',
          align: 'left',
          sortable: false,
          value: 'name',
        },
        { text: 'Date', value: 'date' },
        { text: 'Speaker Name', value: 'speaker' },
        { text: 'Type', value: 'type' },
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
      selectImage(){
        console.log('select image');
        console.log(this.$refs);
        this.$refs.activity_img.click();
      },
      setImage(){
        this.selectedActivity.image=URL.createObjectURL(this.$refs.activity_img.files[0]);
        this.editedActivity.image=URL.createObjectURL(this.$refs.activity_img.files[0]);
      },
      showEditDialog(course){
        this.selectedActivity = course;
        this.edit = true;
      },
      deleteActivity (activity) {

        this.$http.put(this.$root.api + '/activities/delete/'+ activity.id,{
          admin_id: this.Admin.id
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          const index = this.activities.indexOf(activity);
          this.activities.splice(index, 1)
        })
      },
      getactivity(){
        this.$http.get(this.$root.api + '/activities?type=' + this.selectedType,{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response=>{
          this.activities= response.body.data;
        }, response => {
          console.log('error');
        })
      },
      updateActivity(){
        var form = new FormData();
        form.append('admin_id', this.Admin.id);
        form.append('name',this.selectedActivity.name);
        form.append('date', this.selectedActivity.date);
        form.append('speaker_name', this.selectedActivity.speaker);
        form.append('type', this.selectedActivity.type);
        form.append('descriptions', this.selectedActivity.descriptions);

        if (this.$refs.activity_img.files[0]!=null) {
          form.append('image', this.$refs.activity_img.files[0]);
        }
        this.$http.post(this.$root.api + '/activities/' +  this.selectedActivity.id, form,       {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.edit = false;
        })
        .then((error)=>{

        })
      },
      save(){
        var form = new FormData();
        form.append('admin_id', this.Admin.id);
        form.append('name',this.editedActivity.name);
        form.append('date', this.editedActivity.date);
        form.append('speaker_name', this.editedActivity.speaker_name);
        form.append('type', this.editedActivity.type);
        form.append('descriptions', this.editedActivity.descriptions);

        if (this.$refs.activity_img.files[0]!=null) {
          form.append('image', this.$refs.activity_img.files[0]);
        }
        this.$http.post(this.$root.api + '/activities', form,       {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          this.dailog = false;
        })
        .then((error)=>{

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
      max-height: 120px !important
      min-height: 0 !important

    .v-text-field--filled input
      margin-top: 0

</style>
