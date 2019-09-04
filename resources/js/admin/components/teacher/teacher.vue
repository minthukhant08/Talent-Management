<template>
	<div>
		<v-btn fab fixed left bottom class="mb-5 mr-3" color="accent" @click='getall'><v-icon>mdi-database-refresh</v-icon></v-btn>
    <v-card>
      <v-tabs
        fixed-tabs
				color="deep-purple accent-4"
      >
        <v-tab >Teachers</v-tab>
        <v-tab >Manage</v-tab>
        <v-tab-item>
          <v-container fluid>
            <v-row>
              <v-col>
                <v-data-table
                :headers="headers"
                :items="users"
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
						v-on:keyup.enter="searchTeacher"
          >
          </v-text-field>
        </v-row>
<!--end scanner list -->

            <v-list subheader  >
              <div
								v-for="user in searchresult"
								:key="user.id">
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
	                  <!-- start dialog -->
	                   <v-btn
										 		v-if="user.type != 'teacher' && user.type != 'admin'"
	                      color="#F57C00"
	                      dark
	                      @click.stop="showDialog(user)"
	                      width="120"
	                      rounded>
	                      Promote
	                    </v-btn>
											<v-btn
	 									 		 v-if="user.type == 'admin'"
	                       dark
	                       width="120"
	                       text>
												 <v-icon
		                        color="#F57C00">
		                        mdi-cancel
		                      </v-icon>
	                     </v-btn>
											<v-btn
	 									 		 v-if="user.type == 'teacher'"
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
        users:[],
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
	computed:{
		Admin(){
			return this.$store.getters.getAdmin;
		}
	},
  methods:{
    getall(){
      	this.$http.get(this.$root.api +'/users', {
	        headers: {
	            Authorization: 'Bearer '+ this.Admin.token
	        }
	      }).then(response => {
          this.users = response.body.data;
      }, response => {

      });
    },

    getCourse(){
        var results=[];
        this.$http.get(this.$root.api +'/courses',{
	        headers: {
	            Authorization: 'Bearer '+ this.Admin.token
	        }
	      }).then(response => {
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
        this.$http.get(this.$root.api + '/batches',{
	        headers: {
	            Authorization: 'Bearer '+ this.Admin.token
	        }
	      }).then(response => {
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
    searchTeacher(){
        this.$http.get(this.$root.api + '/users?admin=1&type=normal&name='+this.search,{
	        headers: {
	            Authorization: 'Bearer '+ this.Admin.token
	        }
	      }).then(response => {
          this.searchresult = response.body.data;
      }, response => {

      });
    },
   updateuser(){
      this.$http.put(this.$root.api + '/users/'+ this.selectedUser.id,
        {
					admin_id: this.Admin.id,
          course_id: this.selectedCourse,
          batch_id:  this.selectedBatch,
          type:'teacher'
      },
			{
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then((response) =>{
        this.dialog = false;
				var index = this.searchresult.indexOf(this.selectedUser);
        this.searchresult[index] = Object.assign({}, {
					image: this.selectedUser.image,
					name : this.selectedUser.name,
					course_id: this.selectedCourse,
					batch_id:  this.selectedBatch,
					type:'teacher'
				});

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
  }
}
</script>
