<template>
  <v-container>
    <v-data-table
          :headers="headers"
          :items="lists"

    >
      <template v-slot:top>
           <v-dialog v-model="dialog" max-width="500px" dark>
             <v-card class="pa-3" >
                  <v-card-text>
                     <v-select
                        :items="assignments"
                        menu-props="auto, overflowY"
                        v-model='selectedAssignment'
                        item-text='name'
                        item-value='id'
                        label="Name">
                     </v-select>

                      <v-text-field
                       v-model="editedItem.marks"
                       label="Mark">
                       </v-text-field>
                  </v-card-text>
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
       console.log('http://localhost:8000/api/v1/users?batch=' + this.User.batch.name + '&course=' + this.User.course.name);
       this.$http.get('http://localhost:8000/api/v1/users?batch=' + this.User.batch.name + '&course=' + this.User.course.name ).then(response=>{
         this.lists=response.body.data;
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

     getAssignment(){
       var results=[];
        this.$http.get('http://localhost:8000/api/v1/assignments').then(response =>{
          results = response.body.data;
          var i;
          for (i = 0;i < results.length; i++) {
            this.assignments.push(
              {name:results[i].name, id: results[i].id});
          }
          this.selectedAssignment = this.assignments[0].id;
          console.log(this.assignments)
        },response => {

        });

      },
      getChosen(){
        console.log(this.choose);
      },

      getAssignment1(){
        var results=[];
         this.$http.get('http://localhost:8000/api/v1/assignments').then(response =>{
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
       this.getAssignment1();
     },
  }
</script>
