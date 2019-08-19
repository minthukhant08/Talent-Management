<template>
	<div id="app">
  <v-app id="inspire">
    <v-card>
      <v-tabs
        background-color="#7266ba"
        color="#F57C00"
        centered
      >
        <v-tab >Teachers</v-tab>
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
                  
                    <span v-if='user.type == "teacher"'>
                     <v-btn color="#F57C00"
                        dark
                        @click.stop="showDialog(user)"
                        width="120"
                        rounded>
                        Promote
                      </v-btn>
                    </span>
                    <span v-else>
                     <v-btn 
                        color="#F57C00"
                        dark
                        @click.stop="showDialog(user)"
                        width="120"
                        rounded>
                        Demote
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
  <v-dialog
    v-model="dialog"
    max-width="290"
  >
    <v-card>
     
      <v-card-text >
        
        
          
            <v-container fluid>
              <v-row align="center">
                <v-col class="d-flex" cols="12" sm="12">
                   <v-autocomplete
                    v-model='selectedCourse'
                    :items="tracks"
                    item-text='name'
                    item-value='id'
                    label="Track"
                  ></v-autocomplete>
                  
                </v-col>
              </v-row>
              <v-row align="center">
                <v-col class="d-flex" cols="12" sm="12">
                   <v-autocomplete
                    v-model='selectedBatch'
                    :items="batchess"
                    item-text='name'
                    item-value='id'
                  ></v-autocomplete>
                </v-col>
              </v-row>
            </v-container>
          
        

      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          color="accent"
          text
          @click="dialog = false"
        >
          Cancel
        </v-btn>

        <v-btn
          color="accent"
          text
          @click="updateuser"
        >
          Save
        </v-btn>
      </v-card-actions>
  </v-card>
  </v-dialog>
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
      tracks:[],
      batchess:[],    
        }
  },
  methods:{
    getall(){

      	this.$http.get('http://localhost:8000/api/v1/users').then(response => {
          this.userss = response.body.data;
      }, response => {

      });
    },

    getCourse(){
        var results=[];
        this.$http.get('http://localhost:8000/api/v1/courses').then(response => {
          results = response.body.data;
          var i;
          for (i = 0; i < results.length; i++) { 
            this.tracks.push(
              {name:results[i].name, id: results[i].id});
          }
          this.selectedCourse = this.tracks[0].id;
          console.log(this.tracks)
      }, response => {

      });
    },

    getBatch(){
        var results=[];
        this.$http.get('http://localhost:8000/api/v1/batches').then(response => {
          results = response.body.data;
          var i;
          for (i = 0; i < results.length; i++) { 
            this.batchess.push(
              {name:results[i].name, id: results[i].id});
          }
          this.selectedBatch = this.batchess[0].id;
          console.log(this.batchess)
      }, response => {

      });
    },
    searchScanner(){

        this.$http.get('http://localhost:8000/api/v1/users?name='+this.search).then(response => {
          this.searchresult = response.body.data;
      }, response => {

      });
    },
   updateuser(){
      this.$http.put('http://localhost:8000/api/v1/users/'+ this.selectedUser.id,
        { 
          course_id: this.selectedCourse, 
          batch_id:  this.selectedBatch, 
          type:'teacher'
      }).then((response) =>{
        this.dialog = false;
      })
      .then((error)=>{

      })

    },
    showDialog(user){
      this.dialog =true;
      this.selectedUser = user;
    }
  
     
  },

  created(){
  	
  	this.getall();
    this.getCourse();
    this.getBatch();
  },
  computed:{

  }
}
</script>