<template>
  <v-layout row class="pt-3">
      <v-flex xs0 sm1 md3 lg3 xl3>
      </v-flex>
      <v-flex xs12 sm10 md6 lg6 xl6>
              <v-data-table
                :headers="headers"
                :items="assignments"
                class="elevation-2"
               >
                  <template v-slot:top>
                     <v-toolbar flat color="accent">
                         <v-text> Assignments</v-text>
                         <v-spacer></v-spacer>
                         <v-btn  fab color="primary" class="mb-1" @click="dialog = true" small><v-icon>create</v-icon></v-btn>

                         <v-dialog v-model="dialog" max-width="500px" dark>
                            <v-card>
                               <v-col cols="12" sm="12" md="12">
                                   <v-text-field
                                     placeholder="Add Assignment"
                                     single-line
                                     outlined
                                     hide-details
                                     v-model='assignment_name'
                                   ></v-text-field>
                               </v-col>
                                   <v-card-actions>
                                      <v-spacer></v-spacer>
                                        <v-btn text @click="close">Cancel</v-btn>
                                        <v-btn  color="accent" text @click="save">Post</v-btn>
                                   </v-card-actions>
                          </v-card>
                       </v-dialog>
                  </v-toolbar>
              </template>
                <template v-slot:item.date="{item}">
                  {{convert(item.date)}}
                </template>
                  <template v-slot:item.action="{item}">
                      <v-icon
                        small
                        @click="deleteItem(item)"
                      >
                        delete
                      </v-icon>
                </template>
           </v-data-table>
      </v-flex>
       <v-flex xs0 sm1 md3 lg3 xl3>
       </v-flex>
    </v-layout>
</template>


<script>
  export default {
    data: () => ({
      dialog: false,
      headers :[
        {text: 'Assignment', align: 'left',sortable: false,value: 'name',},
        {text: 'Date',align: 'center', sortable: false,value:'date',},
        { text: 'Action',align:'right',sortable: false, value: 'action',},
      ],
      assignment_name:'',
      user_date:'',
      assignments:[],
      date:'',
      created_at:'',

    }),

    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },


    methods: {
     getall(){
       this.$http.get(this.$root.api + '/assignments?teacher_id=' + this.User.id).then(response=>{
         this.assignments=response.body.data;
       },response=>{
       });
     },
      deleteItem (assignment) {
        const index = this.assignments.indexOf(assignment)
        this.$http.delete(this.$root.api + '/assignments/'+assignment.id).then((response) =>{
          console.log(response);
          const index = this.assignments.indexOf(assignment)
          this.assignments.splice(index, 1)
        })
      },
      save(){
        this.$http.post(this.$root.api + '/assignments', {
          "name":this.assignment_name,
          "teacher_id":this.User.id,
          "date":this.created_at,

        }).then((response) =>{
          var d = new Date();
          d = this.convert(d);
          this.assignments.unshift({"name":this.assignment_name, "teacher_id":this.User.id,"date":d});
          this.dialog = false;
        })
        .then((error) =>{

        })
      },

      convert(date){
        // console.log('date is ' + date);
        return new Date(date).toString().substr(0,10);

      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      }
    },
    created(){
      this.getall();
    },

}
</script>
