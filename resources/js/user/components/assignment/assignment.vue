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
        <v-toolbar flat color="#FF8883">

        <v-dialog v-model="dialog" max-width="500px" dark>
          <template v-slot:activator="{ on }">
            <v-text>List Of Assignments</v-text>
           <v-btn color=" drak gradient" dark class="mb-2" v-on="on" ><v-icon align="right">add</v-icon></v-btn>
          </template>
          <v-card>
            <v-col cols="12" sm="12" md="12">
               <v-text-field
                 placeholder="Placeholder"
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
        { text: 'Actions', value: 'action', sortable: false,align: 'center', },
      ],
      assignment_name:'',
      assignments:[],

    }),


    methods: {
     getall(){
       this.$http.get("http://localhost:8000/api/v1/assignments").then(response=>{
         this.assignments=response.body.data;
       },response=>{
       });
     },
      deleteItem (assignment) {
        const index = this.assignments.indexOf(assignment)
        confirm('Are you sure you want to delete this item?' + assignment) && this.assignments.splice(index, 1)
      },
      save(){
        this.$http.post('http://localhost:8000/api/v1/assignments', {
          "name":this.assignment_name,
          "teacher_id": 1,
        }).then((response) =>{
          this.assignments.unshift({"name":this.assignment_name, "teacher_id": 1});
          this.dialog = false;
        })
        .then((error) =>{

        })
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
