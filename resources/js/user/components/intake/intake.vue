<template>
  <v-container style="height:100%;">
    <v-layout
      align="center"
      justify="center"
      style="height: 100%;"
    >
      <v-card width="100%"class="pa-6"

      >
        <v-switch  label="Intake" :value="intakes.available"  ></v-switch>
        <p>Google form</p>
        <v-text-field
            label="Link"
            color="#f57c00"
            outlined
            :value="intakes.form_link">
        </v-text-field>
        <div class="text-right">
          <v-btn color="#f57c00" @click="editIntake()">Update</v-btn>
      </div>
      </v-card>
    </v-layout>
  </v-container>
</template>

<script>
export default{
  data(){
    return{
      intakes:[],

      dialog:false
    }
  },

  methods:{
    goRoute($route){
      this.$router.push($route).catch(err => {});
    },
    getIntake(){
      this.$http.get(this.$root.api + '/intake').then(response=>{
        console.log(response.body.data[0]);
        this.intakes= response.body.data[0];
        console.log(this.intakes);
      }, response => {
        console.log('error');
      })
    },

    editIntake(){
      this.$http.put(this.$root.api + '/intake',{available:0,form_link:"htuhjhjh"}).then(response=>{

      }, response => {
        console.log('error');
      })
    },

  },
  created(){
    this.getIntake();
  }
}
</script>
