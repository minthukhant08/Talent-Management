<template>
	<div>
		<v-btn fab fixed left bottom color="accent" @click='getStudents'><v-icon>mdi-database-refresh</v-icon></v-btn>
      <v-tabs
        color="deep-purple accent-4"
        fixed-tabs
      >
        <v-tab >Students</v-tab>
        <v-tab >Manage</v-tab>
        <v-tab-item>
          <v-container fluid>
						<v-layout>
							<v-flex>
								<v-autocomplete
								 v-model='search_selected_course'
								 :items="search_courses"
								 item-text='name'
								 item-value='name'
								 label="Track"
								 @change="getStudents"
							 ></v-autocomplete>
							</v-flex>
							<v-flex>
								<v-autocomplete
								 v-model='search_selected_batch'
								 :items="search_batches"
								 item-text='name'
								 item-value='name'
								 label="Batch"
								 @change="getStudents"
							 ></v-autocomplete>
							</v-flex>
						</v-layout>

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

							<template v-slot:item.action="{item}">
				        <v-icon
				          small
									@click="demoteuser(item)"
				        >
				          delete
				        </v-icon>
				      </template>

			      </v-data-table>
          </v-container>
        </v-tab-item>
        <!-- Scanner -->
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
	                  <span>
	                     <v-btn color="#F57C00"
	                        dark
	                        @click.stop="showDialog(user)"
	                        width="120"
	                        rounded
	                        >
	                        Promote
	                    </v-btn>
	                  </span>

	                </v-list-item-icon>
	              </v-list-item>
								<v-divider></v-divider>
              </div>
            </v-list>
        </v-container>
        </v-tab-item>
      </v-tabs>
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
                    v-model='promote_selected_course'
                    :items="promote_courses"
                    item-text='name'
                    item-value='id'
                    label="Track"
                  ></v-autocomplete>

                </v-col>
              </v-row>
              <v-row align="center">
                <v-col class="d-flex" cols="12" sm="12">
                   <v-autocomplete
                    v-model='promote_selected_batch'
                    :items="promote_batches"
                    item-text='name'
                    item-value='id'
                    label="Batch"
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
          @click="promoteuser"
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
				search_courses:[],
				search_batches:[],
				search_selected_course:'',
				search_selected_batch:'',
				promote_courses:[],
				promote_batches:[],
      	promote_selected_course:'',
				promote_selected_batch:'',
        dialog: false,
        selectedUser:[],
        headers: [
        { text: 'Image', value: 'image' },
        { text: 'Name', value: 'name' },
				{ text: 'Type', value: 'type' },
				{ text: 'Track', value: 'course.name' },
				{ text: 'Batch', value: 'batch.name' },
        { text: 'Email', value: 'email' },
        { text: 'Phone No', value: 'phone_no' },
				{ text: 'Address', value: 'address' },
				{ text: 'Action', value: 'action' }
      ],
    }
  },
	computed:{
		Admin(){
			return this.$store.getters.getAdmin;
		}
	},
  methods:{
    getStudents(){
			var batch, course;
			if (this.search_selected_batch == "All") {
					batch = "%";
			}else{
					batch = this.search_selected_batch;
			}
			if (this.search_selected_course == "All") {
					course = "%";
			}else{
					course = this.search_selected_course;
			}
      this.$http.get(this.$root.api + '/users?type=student&course=' + course + '&batch=' + batch,{
				headers: {
					Authorization: 'Bearer ' + this.Admin.token
				}
			}).then(response => {
          this.users = response.body.data;
					console.log(response.body.data);
      }, response => {

      });
    },
    getCourse(){
        var results=[];
        this.$http.get(this.$root.api + '/courses/list',{
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then(response => {
          results = response.body.data;
          var i;
          for (i = 0; i < results.length; i++) {
            this.promote_courses.push({name:results[i].name, id: results[i].id});
          }
					this.search_courses = Array.from(this.promote_courses);
					this.search_courses.push({name:'All', id: -1});
          this.promote_selected_course = this.promote_courses[0].id;
					this.search_selected_course = 'All';
      }, response => {

      });
    },
    getBatch(){
        var results=[];
      this.$http.get(this.$root.api + '/batches/list',
			{
				headers: {
					Authorization: 'Bearer ' + this.Admin.token
				}
			}).then(response => {
				results = response.body.data;
				var i;
				for (i = 0; i < results.length; i++) {
					this.promote_batches.push({name:results[i].name, id: results[i].id});
				}
				this.search_batches = Array.from(this.promote_batches);
				this.search_batches.push({name:'All', id: -1});
				this.promote_selected_batch = this.promote_batches[0].id;
				this.search_selected_batch = 'All';
      }, response => {

      });
    },
     searchUser(){
      this.$http.get(this.$root.api +'/users?type=normal&admin=1&name='+this.search,{
        headers: {
          Authorization: 'Bearer ' + this.Admin.token
        }
      }).then((response) => {
        this.searchresult = response.body.data;
      }, response => {

      });
    },

    promoteuser(){
      this.$http.put(this.$root.api +'/users/'+ this.selectedUser.id + '?editedby=1',
      {
          course_id: this.promote_selected_course,
          batch_id : this.promote_selected_batch,
          type:'student'
      },
			{
				headers: {
					Authorization: 'Bearer ' + this.Admin.token
				}
			}).then((response) =>{
        this.dialog = false;
				var index = this.searchresult.indexOf(this.selectedUser)
        this.searchresult.splice(index, 1)
      })
      .then((error)=>{

      })

    },

		demoteuser(user){
      this.$http.put(this.$root.api +'/users/'+ user.id + '?editedby=1',
      {
          course_id: null,
          batch_id : null,
          type:'normal'
      },
			{
				headers: {
					Authorization: 'Bearer ' + this.Admin.token
				}
			}).then((response) =>{
        this.dialog = false;
				var index = this.users.indexOf(user)
        this.users.splice(index, 1)
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
		this.getCourse();
    this.getBatch();
		this.getStudents();
  }
}
</script>
