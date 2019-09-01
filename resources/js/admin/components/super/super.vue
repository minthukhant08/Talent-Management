<template>
<v-container>
    <v-btn fab fixed left bottom color="accent" @click='refresh'><v-icon>mdi-database-refresh</v-icon></v-btn>
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
                  v-show="item.id!=1"
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
  						v-on:keyup.enter="searchUser"
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
                       v-if="user.type != 'admin'"
                       dark
                       @click.stop="showDialog(user)"
                       width="120"
                       rounded
                       >
                       Promote
                     </v-btn>
                     <v-btn
  									 		v-if="user.type == 'admin'"
                        dark
                        width="120"
                        text>
 											 <v-icon
 	                        color="#F57C00">
 	                        mdi-check-bold
 	                      </v-icon>
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
            :items="admintypes"
            item-text="name"
            item-value="id"
            label="choose admin"
        ></v-overflow-btn>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn @click='promoteAdmin'>Confirm</v-btn>
      </v-card-actions>
   </v-card>
  </v-dialog>
</v-container>
</template>
<script>
export default{
  data(){
    return{
      type:1,
      admintypes:[{'id':0, name:'Super Admin'},{'id':1, name:'Admin'}],
      selectedUser:'',
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
    Admin(){
      return this.$store.getters.getAdmin;
    }
  },
  methods:{
    refresh(){
      this.getAdmins();
      this.getSuperadmins();
    },
    showDialog(user){
      this.selectedUser=user;
      this.promoteDialog = true;
    },
    deleteAdmin(item){
      console.log(this.Admin.id)
      var _this =this;
      this.$http.post(this.$root.api + '/admin/demote/' + item.id, {
        admin_id: this.Admin.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then(response => {
        if (item.role == 'Admin') {
          var index = this.admin.indexOf(item);
          this.admin.splice(index, 1);
        }else{
          var index = this.superadmin.indexOf(item);
          this.superadmin.splice(index, 1);
        }
      }, response =>{

      });
    },
    promoteAdmin(){
      this.$http.post(this.$root.api +'/admin/promote',
      {
          user_id: this.selectedUser.id,
          role : this.type,
          admin_id: this.Admin.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then((response) =>{
        this.promoteDialog = false;
        var index = this.searchresult.indexOf(this.selectedUser);
        this.searchresult[index] = Object.assign({}, {
					image: this.selectedUser.image,
					name : this.selectedUser.name,
          type : 'admin'
				});
      })
      .then((error)=>{

      })
    },
    getAdmins(){
      console.log(this.Admin.token);
      this.$http.post(this.$root.api + '/admin?type=admin', {
        admin_id:this.Admin.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then(response => {
         this.admin = response.body.data;
         console.log(response.body);
      }, response =>{

      });
    },
    getSuperadmins(){
      this.$http.post(this.$root.api + '/admin?type=superadmin', {
        admin_id:this.Admin.id
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then(response => {
         this.superadmin = response.body.data;
         console.log(response.body);
      }, response =>{

      });
    },
    searchUser(){
     this.$http.get(this.$root.api +'/users?admin=1&name='+this.search,{
       headers: {
           Authorization: 'Bearer '+ this.Admin.token
       }
     }).then((response) => {
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
