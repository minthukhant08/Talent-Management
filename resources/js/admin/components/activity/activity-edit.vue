<template>
  <v-row>

          <v-layout row ma-3>

            <v-flex xs0 sm0 md2 lg2 xl2>
              <img src="" alt="">
            </v-flex>

            <v-flex xs12 sm12 md8 lg8 xl8>
            <v-layout row ma-3>
              <v-card ma5
                class="mx-auto"
                width="100%"
                style="border-radius:10px;"
                color="accent"
              >
                <v-list>
                  <v-list-item>


                    <v-list-item-content>
                      <v-list-item-title><h3>Activity Edit</h3></v-list-item-title><br><br>

                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md4 lg3 xl3
                          mt-7
                          ml-4
                          >
                            Name
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            filled
                            v-model="activities.name"
                            color="accent"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Speaker Name
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            v-model="activities.speaker"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Description
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            v-model="activities.descriptions"
                            filled
                            color="black"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Date
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-text-field
                            v-model="activities.date"
                            filled
                            color="black"@click= "showDatePicker(index,activities.date, 'end')"></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Type
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-autocomplete
                              :items="components"
                              v-model="activities.type"
                            ></v-autocomplete>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                      <v-list-item>
                        <v-layout row ma3>
                          <v-flex xs6 sm6 md3 lg3 xl3
                          mt-7
                          ml-4
                          >
                          Image
                          </v-flex>
                          <v-flex xs4 sm6 md8 lg8 xl8>
                            <v-img
                            :src="activities.image"
                            aspect-ratio="1"
                            class="grey lighten-2"
                            max-width="200"
                            max-height="200"></v-img>
                          </v-flex>
                        </v-layout>
                      </v-list-item>
                    </v-list-item-content>

                  </v-list-item>
                </v-list>

                  <v-spacer></v-spacer>
                  <v-btn text>Remove</v-btn>
                  <v-btn
                   @click="updateactivity" text>Update</v-btn>


              </v-card>
                    <v-btn
                    class="ma-2"
                    outlined
                    color="accent"
                    >ADD<v-icon>add</v-icon></v-btn>
            </v-layout>
            </v-flex>

            <v-flex xs12 sm12 md2 lg2 xl2>

            </v-flex>

          </v-layout>
          <v-dialog v-model="datepicker" max-width="300">
            <v-date-picker v-model="picker" @change="changeDate()"></v-date-picker>
          </v-dialog>


  </v-row>



</template>
<script>
  import commonmethods from '../../mixins/commonMethods';
  export default {

  mixins:[commonmethods],
  data(){
    return{
        components:['Post','Annoucment'],
        editedactivity:[],
        activities:[],
        datepicker:false,
        picker:'',
        currenttextbox:'',
        datetype:''
      }
  },
  computed:{
    User(){
      this.$store.getters.getUser;
    }
  },
  methods:{
   changeDate(){
     if (this.datetype == "end") {
       this.activities[this.currenttextbox].end_date = this.picker;
     }else{
       this.activities[this.currenttextbox].start_date = this.picker;
     }
   },
   showDatePicker(index, current, type){
      this.picker = current;
      this.datepicker = true;
      this.currenttextbox = index;
      this.datetype = type;
   },
   updateactivity(){
      this.$http.put(this.$root.api + '/activities/'+ this.$route.params.id, {
        name: this.activities.name,
        speaker: this.activities.speaker,
        descriptions: this.activities.descriptions,
        type: this.activities.type,
        image: this.activities.image
      }).then((response) =>{
        console.log(response);
        this.goRoute('/admin/activityedit/' + this.$route.params.id);

      })
      .then((error)=>{

      })

    },
    getActivity(){
      this.$http.get('http://localhost:8000/api/v1/activities/'+ this.$route.params.id).then((response) =>{
          console.log(response.body.data[0]);
          this.activities = response.body.data[0];
      })
      .then((error)=>{

      })
    }
  },
  created(){
   this.getActivity();
  }
}
</script>
