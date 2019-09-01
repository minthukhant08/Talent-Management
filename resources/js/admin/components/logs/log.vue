<template>
    <v-container>
      <v-btn fab fixed left bottom color="accent" @click='getLogs'><v-icon>mdi-database-refresh</v-icon></v-btn>
      <v-data-table
        :headers="headers"
        :items="logs"
        class="elevation-1"
      >
      <template v-slot:item.image="{ item }">
        <v-avatar>
          <img :src="item.admin.image" alt="avatar">
        </v-avatar>
      </template>
    </v-data-table>
    </v-container>
</template>
<script>
export default{
  data(){
    return{
      logs:[],
      headers: [
         { text: 'Person', value: 'image' },
         { text: 'Name', value: 'admin.name' },
         { text: 'Email', value: 'admin.email' },
         { text: 'Action', value: 'action' },
         { text: 'Category', value: 'category' },
         { text: 'Descriptions', value: 'descriptions' }
       ],
    }
  },
  computed:{
    Admin(){
      return this.$store.getters.getAdmin;
    }
  },
  methods:{

    getLogs(){
      console.log(this.Admin.token);
      this.$http.post(this.$root.api + '/admin/logs', {
        admin_id:1
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then(response => {
         this.logs = response.body.data;
         console.log(response.body.data);
      }, response =>{

      });
    }
  },
  created(){
    this.getLogs();
  }
}
</script>
