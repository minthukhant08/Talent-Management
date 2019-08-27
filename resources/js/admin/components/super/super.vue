<template>
<v-container>
    <v-dialog v-model="create">
      <v-card>
        dsf
      </v-card>
    </v-dialog>
    <v-tabs
        background-color="white"
        color="deep-purple accent-4"
        fixed-tabs
      >
        <v-tab>Super Admin</v-tab>
        <v-tab>Admin</v-tab>
        <v-tab>Promote</v-tab>

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
            <template v-slot:item.remove="{item}">
                <v-icon
                  small


                >
                  delete
                </v-icon>
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
            <template v-slot:item.remove="{item}">
              <v-icon
                small
                @click="deleteAdmin(item)"
              >
                delete
              </v-icon>
            </template>
           </v-data-table>
          </v-container>
        </v-tab-item>
        <v-tab-item>
          <v-container>
            <v-text-field
              class="mx-5 pt-1"
              flat
              hide-details
              label="Search"
              prepend-inner-icon="search"
              solo-inverted
              v-model='search'
  						v-on:keyup.enter="searchScanner"
            >
            </v-text-field>
            <v-list subheader>
              <div
                v-for="user in searchresult"
                :key="user.id"
              >
              <v-list-item>
                <v-list-item-avatar >
                  <v-img
                    :src='user.image'
                    aspect-ratio="1"
                    class="grey lighten-2"
                    max-width="500"
                    max-height="300"
                  ></v-img>
                </v-list-item-avatar>

                <v-list-item-content >
                  <v-list-item-title >{{user.name}}</v-list-item-title>
                </v-list-item-content>

                 <v-list-item-content>
                  <v-list-item-title >{{user.type}}</v-list-item-title>
                </v-list-item-content>

                <v-list-item-icon>

                   <v-btn color="#F57C00"
                      dark
                      @click.stop="showDialog(user)"
                      width="120"
                      rounded
                      >
                      Promote
                    </v-btn>
                </v-list-item-icon>
              </v-list-item>
              <v-divider></v-divider>
            </div>
            </v-list>
        </v-container>
        </v-tab-item>
      </v-tabs>
  </v-card>
  <v-dialog v-model="promoteDialog" max-width="350">
    <v-card class="pa-3">
      <v-card-title >
        Choose Admin Level
      </v-card-title>
      <v-card-text class="px-3">
        <v-overflow-btn
            class="my-2"
            v-model="type"
            :items="['Admin', 'Super Admin']"
            label="Overflow Btn"
            target="#dropdown-example"
        ></v-overflow-btn>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn>Confirm</v-btn>
      </v-card-actions>
   </v-card>
  </v-dialog>
</v-container>
</template>
<script>
export default{
  data(){
    return{
      type:"Admin",
      promoteDialog:false,
      create:false,
      superadmins:[],
      admin:[],
      superadmin:[],
      search:'',
      searchresult:[],
      headers: [
         {
           text: 'Profile',
           align: 'left',
           sortable: false,
           value: 'image',
         },
         { text: 'Name', value: 'name' },
         { text: 'Email', value: 'email' },
         { text: 'Role', value: 'role' },
         { text: 'Remove', value: 'remove'}
       ],
    }
  },
  computed:{
    User(){
      return this.$store.getters.getUser;
    }
  },
  methods:{
    showDialog(user){
      this.promoteDialog = true;
    },
    deleteAdmin(item){
      console.log(this.User.id)
      var _this =this;
      this.$http.post(this.$root.api + '/admin/demote/' + item.id, {
        admin_id:1
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.User.token
        }
      }).then(response => {
        var index = this.admin.indexOf(item)
        this.admin.splice(index, 1)
      }, response =>{

      });
    },
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
    },
    searchScanner(){
      console.log('dfd');
       this.$http.get(this.$root.api +'/users?name='+this.search).then((response) => {
         console.log(this.searchresult );
         this.searchresult = response.body.data;
     }, response => {
       console.log(response);
     });
   },
  },
  created(){
    this.getAdmins();
    this.getSuperadmins();
  }
}
</script>
