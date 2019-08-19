<template>
  <v-data-table
        :headers="headers"
        :items="lists"
  >
  <template v-slot:top>
       <v-dialog v-model="dialog" max-width="500px" dark>
         <v-card class="pa-3" >
            <v-text-field
              label="Name"
              clearable
            ></v-text-field>
           <v-select
             :items="items"
             label="Assignment"
             clearable
           ></v-select>
            <v-text-field
              label="Mark"
              clearable
            ></v-text-field>
        <v-card-actions>
          <v-spacer></v-spacer>
           <v-btn
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
</template>
<script>
  export default {
    data () {
     return {
       items: ['Assignment-1', 'Assignment-2', 'Assignment-3', 'Assignment-4'],
        headers: [
          { text: 'Profile',align: 'left',sortable: false,value: 'image'},
          { text: 'Name', value: 'name' },
          { text: 'Email', value: 'email' },
          { text: 'Phone', value: 'phone_no' },
          { text: 'Action', value: 'action'},

        ],
        lists: [],
        dialog:false,
      }
    },
    methods: {
     getall(){
       this.$http.get("http://localhost:8000/api/v1/users?batch=Mrs. Emely Strosin Jr.&course=Ona Veum&type=student").then(response=>{

         this.lists=response.body.data;
       },response=>{
       });
     },
      editItem (item) {
       this.editedIndex = this.lists.indexOf(item)
       this.editedItem = Object.assign({}, item)
       this.dialog = true
     },
   },

     created(){
       this.getall();
     },
  }
</script>
