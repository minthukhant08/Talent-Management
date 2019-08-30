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
            <v-toolbar-title>New Users Per Month</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-switch  label="Intake"  ></v-switch>
            <p>Google form</p>
            <v-text-field
                label="Link"
                color="accent"
                outlined
                >
            </v-text-field>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="accent" text>Update</v-btn>
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
            <line-chart :myheight="300" :data1='this.data1' :data2='this.data2'></line-chart>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 md4 lg6 xl 6>
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
      </v-flex>
      <v-flex xs12 sm12 md4 lg6 xl 6>
        <v-card class="ma-2">
          <v-toolbar
            color="primary"
            dark
            dense
          >
            <v-toolbar-title>Number of Users in the system</v-toolbar-title>
          </v-toolbar>
          <doughnut-chart :data1='this.data1'></doughnut-chart>
        </v-card>
      </v-flex>
      <v-flex xs12 sm12 md4 lg6 xl 6>
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
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import linechart from '../charts/linechart.vue'
import doughnut from '../charts/doughnut.vue'
import radarchart from '../charts/radarchart.vue'
export default {
  components:{
    'line-chart' : linechart,
    'doughnut-chart' : doughnut,
    'radar-chart' : radarchart
  },
  data(){
    return{
      data1: ['something', 'ff', 'dfdf', 'sdfdsf'],
      data2: ['something', 'ff', 'dfdf', 'sdfdsf']
    }
  }
}
</script>
