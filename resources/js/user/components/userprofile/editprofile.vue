<template>
	<v-container>
		<v-layout row>
			<v-flex xs0 sm0 md2 lg2 xl2>
      		</v-flex>

      		<v-flex xs12 sm12 md8 lg8 xl8 >

                <v-layout row mr-3>
                	<v-flex xs12 sm12 md4 lg4 xl4   class="text-center pt-5" >
                		<v-avatar size="170"  >
		                  <img src="https://cdn.vuetifyjs.com/images/lists/ali.png" alt="avatar">
		                </v-avatar>
		           	</v-flex  >


		           	<v-flex xs12 sm12 md8 lg8 xl8  class="pt-8 " >
		           		<v-layout>
		           			<v-flex xs3 sm3 md3 lg3 xl3></v-flex>
		           			<v-flex xs8 sm8 md8 lg8 xl8 >
		           				<v-layout >
					           		<v-flex xs4 sm4 md4 lg4 xl4  class="pt-8">Name</v-flex>
					           		<v-flex xs8 sm8 md8 lg8 xl8 class="pt-0">
						           		<v-text-field
								            v-model="User.name"
								            :value="User.name"
								            color="#F57C00"

						            	></v-text-field>
					           		</v-flex>

					           	</v-layout>
					           	<v-layout >
					           		<v-flex xs4 sm4 md4 lg4 xl4  class="pt-8">Email</v-flex>
					           		<v-flex xs8 sm8 md8 lg8 xl8 class="pt-0">
						           		<v-text-field
								            v-model="User.email"
								            :value="User.email"
								            color="#F57C00"

						            	></v-text-field>
					           		</v-flex>

					           	</v-layout>
					           	<v-layout >
					           		<v-flex xs4 sm4 md4 lg4 xl4  class="pt-8">Phone No</v-flex>
					           		<v-flex xs8 sm8 md8 lg8 xl8 class="pt-0">
						           		<v-text-field
								            v-model="User.phone_no"
								            :value="User.phone_no"
								            color="#F57C00"

						            	></v-text-field>
					           		</v-flex>
					           	</v-layout>

					           	<v-layout >
					           		<v-flex xs4 sm4 md4 lg4 xl4  class="pt-8">Address</v-flex>
					           		<v-flex xs8 sm8 md8 lg8 xl8 class="pt-0">
						           		<v-text-field
								            v-model="User.address"
								            :value="User.address"
								            color="#F57C00"

						            	></v-text-field>

					           		</v-flex>

					           	</v-layout>
					           	<v-layout>
					           		<v-flex xs4 sm4 md4 lg4 xl4  class="pt-8"></v-flex>
					           		<v-flex xs8 sm8 md8 lg8 xl8 class="pt-0">
					           				<v-btn class="mx-2 mb-10" fab bottom right fixed small color="accent">
	      											<v-icon >update</v-icon>
	   				 								</v-btn>
					           		</v-flex>

					           	</v-layout>
		           			</v-flex>
		           			<!-- <v-flex xs1 sm1 md1 lg1 xl1></v-flex> -->
		           		</v-layout>

		           	</v-flex>

		           	<!-- body -->


                </v-layout>
    		</v-flex>

      		<v-flex xs0 sm0 md2 lg2 xl2 >
      		</v-flex>
		</v-layout >




	 </v-container>
</template>
<script>
	export default {
  data(){
    return{
        user:[],
      }
  },
	computed:{
		User(){
			return this.$store.getters.getUser;
		}
	},
  methods:{


  }

}
</script>
