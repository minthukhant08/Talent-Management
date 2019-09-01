<template>
  <v-card
    max-width="480"
    class="mx-auto mt-10 mb-10"
  >
    <v-img

      :src="editeduser.image"
      height="300px"
      dark
    >
      <v-row class="fill-height">
        <v-card-title>
          <v-spacer></v-spacer>
        </v-card-title>

        <v-spacer></v-spacer>

        <v-card-title class="white--text pl-12 pt-12">
          <div class="display-1 pl-12 pt-12"></div>
        </v-card-title>
      </v-row>
    </v-img>

    <v-list >
      <v-list-item  >
        <v-list-item-icon>
          <v-icon color="accent">person</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-text-field
          v-model="editeduser.name"
    			color="accent"
    			label="Name"

		></v-text-field>
        </v-list-item-content>

      </v-list-item>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent" class="pt-4">email</v-icon>
        </v-list-item-icon>

        <v-list-item-content >
          <v-text-field
			v-model="editeduser.email"
			color="accent"
			label="Email"

		></v-text-field>
        </v-list-item-content>

      </v-list-item>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">phone</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
         	<v-text-field
    			v-model="editeduser.phone_no"
    			color="accent"
    			label="Phone No"

    		></v-text-field>
        </v-list-item-content>

      </v-list-item>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">public</v-icon>
        </v-list-item-icon>



        <v-list-item-content >
          <v-text-field
    			v-model="editeduser.nrc_no"
    			color="accent"
    			label="NRC_No"

		    ></v-text-field>
        </v-list-item-content>

      </v-list-item>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">cake</v-icon>
        </v-list-item-icon>




        <v-list-item-content >
        	<v-text-field
    			v-model="editeduser.date_of_birth"
    			color="accent"
    			label="Date Of Birth"

    		></v-text-field>
        </v-list-item-content>

      </v-list-item>

      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="accent">home</v-icon>
        </v-list-item-icon>


        <v-list-item-content >
          <v-text-field
  			v-model="editeduser.address"
  			color="accent"
  			label="Address"

  		></v-text-field>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>


      <v-list-item >
        <v-list-item-content >
           <v-btn
            color="accent"
            @click="updateuser"
            >save</v-btn>

        </v-list-item-content>

      </v-list-item>
    </v-list>
  </v-card>
</template>
<script>
 import commonmethods from '../../mixins/commonMethods';
	export default {
    mixins:[commonmethods],
  data(){
    return{
        editeduser:[]
      }
  },
  methods:{


   updateuser(){
      this.$http.put(this.$root.api + '/users/'+ this.editeduser.id, {
        name: this.editeduser.name,
        email: this.editeduser.email,
        phone_no: this.editeduser.phone_no,
        nrc_no: this.editeduser.nrc_no,
        nrc_no: this.editeduser.nrc_no,
        address: this.editeduser.address,

      }).then((response) =>{
        this.goRoute('/profile/' + this.editeduser.id);
      })
      .then((error)=>{

      })

    },

  },
  created(){
    this.editeduser = this.$store.getters.getUser;

  }

}
</script>
