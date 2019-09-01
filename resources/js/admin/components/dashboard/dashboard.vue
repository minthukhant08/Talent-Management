<template>
  <v-container >
    <v-layout row wrap>
      <v-flex xs12 sm12 md12 lg12 xl 12>
        <v-card width="100%" class="ma-2"

        >
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Manage Intake for another batch</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-switch  :label="this.btn_intake" v-model="intake" ></v-switch>
            <p>Google form</p>
            <v-text-field
                label="Link"
                color="accent"
                outlined
                v-model="form_link"
                >
            </v-text-field>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="accent" text @click='updateIntakeStatus()'>execute</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 md12 lg12 xl 12>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>New Users Per Month</v-toolbar-title>
          </v-toolbar>
            <line-chart :myheight="300" ></line-chart>
        </v-card>
      </v-flex>
      <!-- <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Number of Admins</v-toolbar-title>
          </v-toolbar>
          <line-chart :data1='this.data1' :data2='this.data2'></line-chart>
        </v-card>
      </v-flex> -->
      <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Number of Users in the system</v-toolbar-title>
          </v-toolbar>
          <doughnut-chart></doughnut-chart>
        </v-card>
      </v-flex>
      <!-- <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Number of student in each Track</v-toolbar-title>
          </v-toolbar>
          <line-chart :data1='this.data1' :data2='this.data2'></line-chart>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Number of students in each Track</v-toolbar-title>
          </v-toolbar>
          <radar-chart :data1='this.data1' :data2='this.data2'></radar-chart>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Over all grades</v-toolbar-title>
          </v-toolbar>
          <doughnut-chart :data1='this.data1'></doughnut-chart>
        </v-card>
      </v-flex> -->
    </v-layout>
  </v-container>
</template>

<script>
import linechart from '../charts/newuserspermonth/newuserpermonth.vue'
import doughnut from '../charts/admincount/admins.vue'
import radarchart from '../charts/radarchart.vue'
export default {
  components:{
    'line-chart' : linechart,
    'doughnut-chart' : doughnut,
    'radar-chart' : radarchart
  },
  data(){
    return{
      btn_intake:'update',
      intake:false,
      form_link: '',
      adminCount:{},
      data1: ['something', 'ff', 'dfdf', 'sdfdsf'],
      data2: ['something', 'ff', 'dfdf', 'sdfdsf']
    }
  },
  watch:{
    intake(val){
      if (val) {
        this.btn_intake = 'Stop Intake';
      }else{
        this.btn_intake = 'Send Intake Form to Normal Users';
      }
    }
  },
  computed:{
    Admin(){
      return this.$store.getters.getAdmin
    }
  },
  methods:{
    getIntakeStatus(){
      this.$http.get(this.$root.api + '/intake?admin_id=' + this.Admin.id, {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then((response) =>{
        console.log(response);
        this.intake = response.body.data[0].available;
        this.form_link = response.body.data[0].form_link;
      })
      .then((error)=>{

      })
    },
    updateIntakeStatus(){
      var intake=0;
      if (this.intake) {
        intake = 1;
      }
      this.$http.put(this.$root.api + '/intake',{
        admin_id : this.Admin.id,
        available : intake,
        form_link : this.form_link
      },
      {
        headers: {
            Authorization: 'Bearer '+ this.Admin.token
        }
      }).then((response) =>{

      })
      .then((error)=>{

      })
    }
  },
  created(){
    // this.getIntakeStatus();
  },
  mounted(){

  }
}
</script>
