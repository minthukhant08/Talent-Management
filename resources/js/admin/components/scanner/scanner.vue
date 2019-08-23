<template>
	<div id="app">
  <v-app id="inspire">
    <v-card>
      <v-tabs
        background-color="#7266ba"
        color="#F57C00"
        centered

      >

        <v-tab >Scanners</v-tab>
        <v-tab >Manage</v-tab>
            	
        
        
  
        <v-tab-item>
          <v-container fluid>
            <v-row>
              <v-col>
                <v-data-table 
                :headers="headers"
                :items="userss"
                class="elevation-1"

                >
      				    <template v-slot:item.image="{item}">
                  <v-avatar>
                    <img :src="item.image" alt="avatar">
                  </v-avatar>    
                  </template>
  				      </v-data-table>


              </v-col>
            </v-row>
          </v-container>
        </v-tab-item>
        <!-- Scanner -->
        <v-tab-item>
          <v-container>
            <v-row>
              
              <v-text-field      
                class="mx-5 pt-5"
                flat
                hide-details
                label="Search"
                prepend-inner-icon="search"
                solo-inverted
                v-model='search'
                style="width: 800px;"
              >
              </v-text-field>
            
              </v-text-field>
              <v-btn class="mt-5 ml-3" style="height: 50px;" @click='searchScanner'>Search</v-btn>
            </v-row>
          <!--end scanner list -->
      
            <v-list subheader  >
              <v-list-item 
                v-for="user in searchresult"
                :key="user.id">
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
                  <!-- start dialog -->
                  <span v-if='user.type == "scanner"'>
                     <v-btn color="#F57C00"
                        dark
                        @click="updateuser(user,'normal')"
                        width="120"
                        rounded
                        >
                        Demote
                      </v-btn>
                    </span>
                    <span v-else>
                      <v-btn color="#F57C00"
                        dark
                        @click="updateuser(user, 'scanner')"
                        width="120"
                        rounded>
                        Promote
                      </v-btn>
                    </span>
                  
                </v-list-item-icon>
              </v-list-item>
            </v-list>
        </v-container>
        </v-tab-item>

      </v-tabs>
    </v-card>
  </v-app>
 
</div>
</template>


<script >
	export default {
  data(){
    return{
        search:'',
        userss:[],
        searchresult:[],
        dialog: false, 
        selectedUser:[],
        selectedCourse:'',
        selectedBatch:'',
        headers: [
      
        { text: 'Image', value: 'image' },
        { text: 'Name', value: 'name' },
        { text: 'email', value: 'email' },
        { text: 'Phone No', value: 'phone_no' },
      
    ],    
        }
  },
  methods:{
    getall(){

      	this.$http.get('http://localhost:8000/api/v1/users').then(response => {
          this.userss = response.body.data;
      }, response => {

      });
    },
    
     searchScanner(){

        this.$http.get('http://localhost:8000/api/v1/users?name='+this.search).then(response => {
          this.searchresult = response.body.data;
      }, response => {

      });
    },
    updateuser(user, type){
      console.log(user);
      this.$http.put('http://localhost:8000/api/v1/users/'+ user.id,
        { 
          type: type
        }).then((response) =>{
        this.dialog = false;
      })
      .then((error)=>{

      })

    }
    
  },

  created(){
  	
  	this.getall();
  },
  computed:{

  }
}
</script>