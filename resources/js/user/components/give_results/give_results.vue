<template>
  <v-container>
    <v-data-table
          :headers="headers"
          :items="lists"
    >
          <template v-slot:top>
             <div>
                <v-autocomplete
                    dark
                    v-model="selectedAssignment"
                    :items="items"
                    clearable
                    hide-details
                    hide-selected
                    item-text="name"
                    item-value="id"
                    label="Search for a assignment..."
                    solo
                    @change='getall'
                  >
                </v-autocomplete>
          </div>
       </template>
       <template v-slot:item.image="{ item }">
          <v-avatar>
            <img :src="item.image" alt="avatar">
          </v-avatar>
     </template>
     <template v-slot:item.action="{item}">
         <v-icon
           small
           @click="editItem(item)"
         >
         create
        </v-icon>
     </template>
   </v-data-table>
      <v-dialog v-model="dialog" max-width="500px" dark>
           <v-card
              max-width="500"
              class="mx-auto"
               >
                <v-app-bar color="blue">
                  <v-toolbar-title>Student Result</v-toolbar-title>
                </v-app-bar>
                <div class="pa-3">
                      <v-text-field
                        outlined
                        hide-details
                        v-model='editedItem.marks'
                        label="Enter Marks"
                        class="pb-5"
                      ></v-text-field>
                      <v-textarea
                        v-model='editedItem.comments'
                        outlined
                        hide-details
                        label="Enter Comments"
                      ></v-textarea>
               </div>
                   <v-card-actions>
                     <v-spacer></v-spacer>
                         <v-btn
                         @click="save"
                          text
                        color="accent">
                        Confirm
                        </v-btn>
                 </v-card-actions>
            </v-card>
       </v-dialog>
    </v-container>
 </template>
<script>
  export default {
    data () {
     return {
        selectedAssignment:'',
        headers: [
          { text: 'Profile',align: 'left',sortable: false,value: 'image'},
          { text: 'Name', value: 'name' },
          { text: 'Email', value: 'email' },
          { text: 'Phone', value: 'phone_no' },
          { text: 'Mark', value: 'marks' },
          { text: 'Action', value: 'action'},

        ],
        lists: [],
        dialog:false,
        selectedAssignment:'',
        choose:'',
        assignments:[],
        items:[],
        editedItem:'',
        editedIndex:''

      }
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
     getall(){


       this.$http.get(this.$root.api + '/users/giveresults?assignment_id=' + this.selectedAssignment,{
         headers: {
           Authorization: 'Bearer '+ this.User.token
         }
       } ).then(response=>{
         this.lists=response.body.data;
       },response=>{
       });
     },
      editItem (item) {

       this.editedIndex = this.lists.indexOf(item)
       this.editedItem = Object.assign({}, item)
       this.dialog = true
     },
     save(){
         console.log(this.editedItem);
       this.$http.put(this.$root.api + '/results/'+ this.editedItem.id, {
         "student_id":this.editedItem.student_id,
         "assignment_id":this.editedItem.assignment_id,
         "marks":this.editedItem.marks,
         "comments":this.editedItem.comments,
       }).then((response) =>{
         Object.assign(this.lists[this.editedIndex], this.editedItem)
         this.dialog = false;
       })
       .then((error) =>{

       })
     },

      getChosen(){
        console.log(this.choose);
      },

      getAssignment(){
        var results=[];
         this.$http.get(this.$root.api + '/assignments?teacher_id=' + this.User.id,{
           headers: {
             Authorization: 'Bearer '+ this.User.token
             }
           }).then(response =>{
           results = response.body.data;
           var i;
           for (i = 0;i < results.length; i++) {
             this.items.push(
               {name:results[i].name, id: results[i].id});
           }
           this.choose = this.items[0].id;
           console.log(this.items)
         },response => {

         });

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
       this.getAssignment();
     },
  }
</script>
