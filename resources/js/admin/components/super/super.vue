<template>
  <div >
    <v-dialog v-model="create">
      <v-card>
        dsf
      </v-card>
    </v-dialog>
    <v-btn fab fixed bottom right color=accent><v-icon>mdi-create</v-icon></v-btn>
    <v-tabs
        background-color="white"
        color="deep-purple accent-4"
        right
      >
        <v-tab>Super Admin</v-tab>
        <v-tab>Admin</v-tab>

        <v-tab-item>
          <v-container fluid>
            <v-data-table
              :headers="headers"
              :items="superadmin"
              class="elevation-1"
            >
            <template v-slot:item.image="{ item }">
              <v-avatar>
                <img :src="item.image" alt="avatar">
              </v-avatar>
            </template>
          </v-data-table>
          </v-container>
        </v-tab-item>
        <v-tab-item>
          <v-container fluid>
            <v-data-table
              :headers="headers"
              :items="admin"
              class="elevation-1"
            >
            <template v-slot:item.image="{ item }">
              <v-avatar>
                <img :src="item.image" alt="avatar">
              </v-avatar>
            </template>
           </v-data-table>
          </v-container>
        </v-tab-item>

      </v-tabs>
  </div>

</template>
<script>
export default{
  data(){
    return{
      create:false,
      superadmins:[],
      admin:[],
      superadmin:[],
      headers: [
         {
           text: 'Profile',
           align: 'left',
           sortable: false,
           value: 'image',
         },
         { text: 'Name', value: 'name' },
         { text: 'Email', value: 'email' },
         { text: 'Role', value: 'role' }
       ],
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{
    getAdmins(){
      console.log(this.User.token);
      this.$http.post(this.$root.api + '/admin?type=admin', {
        admin_id:this.User.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
         this.admin = response.body.data;
         console.log(response.body);
      }, response =>{

      });
    },
    getSuperadmins(){
      this.$http.post(this.$root.api + '/admin?type=superadmin', {
        admin_id:this.User.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
         this.superadmin = response.body.data;
         console.log(response.body);
      }, response =>{

      });
    }
  },
  created(){
    this.getAdmins();
    this.getSuperadmins();
  }
}
</script>
