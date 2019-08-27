<template>
	<div>
      <v-tabs
        background-color="blue"
        color="accent"
        fixed-tabs
      >
        <v-tab >Students</v-tab>
        <v-tab >Manage</v-tab>
        <v-tab-item>
          <v-container fluid>
						<v-layout>
							<v-flex>
								<v-autocomplete
								 v-model='stucourse'
								 :items="tracks"
								 item-text='name'
								 item-value='name'
								 label="Track"
								 @change="getStudents"
							 ></v-autocomplete>
							</v-flex>
							<v-flex>
								<v-autocomplete
								 v-model='stubatch'
								 :items="batchess"
								 item-text='name'
								 item-value='name'
								 label="Batch"
								 @change="getStudents"
							 ></v-autocomplete>
							</v-flex>
						</v-layout>

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

							<template v-slot:item.action="{item}">
				        <v-icon
				          small
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
							v-on:keyup.enter="searchScanner"
	          >
	          </v-text-field>
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
				stucourse:'',
				stubatch:'',
        searchresult:[],
        dialog: false,
        selectedUser:[],
        selectedCourse:'',
        selectedBatch:'',
        headers: [

        { text: 'Image', value: 'image' },
        { text: 'Name', value: 'name' },
				{ text: 'Track', value: 'course.name' },
				{ text: 'Batch', value: 'batch.name' },
        { text: 'Email', value: 'email' },
        { text: 'Phone No', value: 'phone_no' },
				{ text: 'Address', value: 'address' },
				{ text: 'Action', value: 'action' }
      ],
      tracks:[],
      batchess:[],


        }
  },
  methods:{

    getStudents(){
			var batch, course;
			if (this.stubatch == "All") {
					batch = "%";
			}else{
					batch = this.stubatch;
			}
			if (this.stucourse == "All") {
					course = "%";
			}else{
					course = this.stucourse;
			}
			console.log(this.$root.api + '/users?type=student&course=' + course + '&batch=' + batch);
      this.$http.get(this.$root.api + '/users?type=student&course=' + course + '&batch=' + batch).then(response => {
          this.userss = response.body.data;
      }, response => {

      });
    },
    getCourse(){
        var results=[];
        this.$http.get(this.$root.api + '/courses').then(response => {
          results = response.body.data;
          var i;
          for (i = 0; i < results.length; i++) {
            this.tracks.push({name:results[i].name, id: results[i].id});
          }
					this.tracks.push({name:'All', id: -1});
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
					this.batchess.push({name:'All', id: -1});
          this.selectedBatch = this.batchess[0].id;
          console.log(this.batchess)
      }, response => {

      });
    },
     searchScanner(){
        this.$http.get(this.$root.api +'/users?type=normal&name='+this.search).then((response) => {
          this.searchresult = response.body.data;
      }, response => {

      });
    },

    updateuser(){
      this.$http.put('http://localhost:8000/api/v1/users/'+ this.selectedUser.id,
        {
          course_id: this.selectedCourse,
          batch_id:this.selectedBatch,
          type:'student'
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
		// this.stucourse = 'All';
    this.getCourse();
    this.getBatch();

  },
  computed:{

  }
}
</script>
