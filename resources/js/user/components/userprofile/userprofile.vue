<template>
	<v-container>
		<v-layout row>

			<v-flex xs0 sm0 md2 lg2 xl2>
      </v-flex>

  		<v-flex xs12 sm12 md8 lg8 xl8 >
				 <v-layout row mr-3>
	          <v-flex xs12 sm12 md4 lg4 xl4 class="text-center pt-5" >
	          		<v-avatar size="170"  >
	                <img src="https://cdn.vuetifyjs.com/images/lists/ali.png" alt="avatar">
	              </v-avatar>
	         	</v-flex  >
				    <v-flex xs12 sm12 md8 lg8 xl8  class="pt-8 " >
							<v-layout>
								<v-flex xs3 sm3 md3 lg3 xl3></v-flex>
								<v-flex xs8 sm8 md8 lg8 xl8>
									<v-layout >
										<v-flex xs4 sm4 md4 lg4 xl4 >Name</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 >{{user.name}}</v-flex>
									</v-layout>

									<v-layout>
										<v-flex xs4 sm4 md4 lg4 xl4 class="pt-10" >Email</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 class="pt-10" >{{user.email}}</v-flex>
									</v-layout>

									<v-layout >
										<v-flex xs4 sm4 md4 lg4 xl4 class="pt-10" >Phone No</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 class="pt-10" >{{user.phone_no}}</v-flex>
									</v-layout>

									<v-layout >
										<v-flex xs4 sm4 md4 lg4 xl4 class="pt-10" >Track</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 class="pt-10" >{{user.course.name}}</v-flex>
									</v-layout>

									<v-layout >
										<v-flex xs4 sm4 md4 lg4 xl4 class="pt-10" >Batch</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 class="pt-10" >{{user.batch.name }}</v-flex>
									</v-layout>

									<v-layout >
										<v-flex xs4 sm4 md4 lg4 xl4 class="pt-10" >Address</v-flex>
										<v-flex xs8 sm8 md8 lg8 xl8 class="pt-10" >{{user.address}}</v-flex>
									</v-layout>
								</v-flex>
							</v-layout>
				    </v-flex>
				 </v-layout>
      </v-flex>

    	<v-flex xs0 sm0 md2 lg2 xl2>
    	</v-flex>
		</v-layout>

		<v-btn class="mx-2 mb-10" fab bottom right fixed small
			color="accent"
			@click='goRoute("/editprofile")'
			>

	    <v-icon >edit</v-icon>
	  </v-btn>

	</v-container>
</template>

<script >
import commonmethods from '../../mixins/commonMethods';
export default {
  mixins:[commonmethods],
  data(){
    return{
        user:[],
      }
  },
  methods:{
    getuser(){
      this.$http.get('http://localhost:8000/api/v1/users/' + this.$route.params.id).then(response => {
          this.user = response.body.data[0];
          console.log(response.body.data[0]);
      }, response => {

      });
    }
  },
  created(){
  	this.getuser();
  }
}
</script>
