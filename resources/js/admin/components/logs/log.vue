<template>
    <v-container>
      <v-data-table
        :headers="headers"
        :items="logs"
        class="elevation-1"
      >
      <template v-slot:item.image="{ item }">
        <v-avatar>
          <img :src="item.image" alt="avatar">
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
         { text: 'Action', value: 'action' },
         { text: 'Category', value: 'category' },
         { text: 'Descriptions', value: 'descriptions' }
       ],
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{

    getLogs(){
      console.log(this.User.token);
      this.$http.post(this.$root.api + '/admin/logs', {
        admin_id:1
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.User.token
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
