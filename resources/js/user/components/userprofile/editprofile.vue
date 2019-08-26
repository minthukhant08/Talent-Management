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

    <v-list two-line >
      <v-list-item  >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">person</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-text-field
          v-model="editeduser.name"
    			color="#F57C00"
    			label="Name"

		></v-text-field>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

      <v-list-item >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">email</v-icon>
        </v-list-item-icon>

        <v-list-item-content >
          <v-text-field
			v-model="editeduser.email"
			color="#F57C00"
			label="Email"

		></v-text-field>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>


      <v-list-item >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">phone</v-icon>
        </v-list-item-icon>
        <v-list-item-content >
         	<v-text-field
    			v-model="editeduser.phone_no"
    			color="#F57C00"
    			label="Phone No"

    		></v-text-field>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">public</v-icon>
        </v-list-item-icon>



        <v-list-item-content >
          <v-text-field
    			v-model="editeduser.nrc_no"
    			color="#F57C00"
    			label="NRC_No"

		    ></v-text-field>
        </v-list-item-content>

      </v-list-item>
      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">cake</v-icon>
        </v-list-item-icon>




        <v-list-item-content >
        	<v-text-field
    			v-model="editeduser.date_of_birth"
    			color="#F57C00"
    			label="Date Of Birth"

    		></v-text-field>
        </v-list-item-content>

      </v-list-item>

      <v-divider inset></v-divider>

       <v-list-item >
        <v-list-item-icon>
          <v-icon color="indigo" class="pt-4">home</v-icon>
        </v-list-item-icon>


        <v-list-item-content >
          <v-text-field
  			v-model="editeduser.address"
  			color="#F57C00"
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
      this.$http.put('http://localhost:8000/api/v1/users/'+ this.editeduser.id, {
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
