<template>
  <v-container>
    <v-data-table
          :headers="headers"
          :items="lists"

    >


      <template v-slot:top>
        <v-toolbar dark>
          <!-- <v-text>Choose a assignment..</v-text> -->
          <v-spacer></v-spacer>
          <v-autocomplete
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
        </v-toolbar>
           <v-dialog v-model="dialog" max-width="500px" dark>
             <v-card class="pa-3" >
               <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    outlined
                    hide-details
                    v-model='editedItem.marks'
                    label="Enter Mark"
                  ></v-text-field>
              </v-col>
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
         console.log('list');
         console.log(this.$root.api + '/users/giveresults?assignment_id=' + this.selectedAssignment);
       },response=>{
       });
     },
      editItem (item) {
        
       this.editedIndex = this.lists.indexOf(item)
       this.editedItem = Object.assign({}, item)
       console.log(this.editedItem);
       this.dialog = true
     },

     save () {
       console.log(this.editedItem);
        if (this.editedIndex > -1) {
          Object.assign(this.lists[this.editedIndex], this.editedItem)
        } else {
          this.lists.push(this.editedItem)
        }
        console.log(this.lists);
        this.close()
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
        this.getall();
       this.getAssignment();
     },
  }
</script>
