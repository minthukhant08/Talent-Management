<template>
  <div class="small">
    <Doughnut :chart-data="datacollection"></Doughnut>
  </div>
</template>

<script>
  import Doughnut from './../doughnut.js'
  export default {
    components: {
      Doughnut
    },
    data () {
      return {
        datacollection: {
                          labels:  ['1', '2', '3', '4', '5', '6'],
                          datasets: [
                          {
                            label: ['1', '2', '3', '4', '5', '6'],
                            backgroundColor: [],
                            data: [1,2,3,4,5,6],
                          },
                          ]
                        },
        AdminCountLabel:[],
        AdminCountData:[]
      }
    },
    created () {
      this.getAdminCount();
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
      getAdminCount(){

        this.$http.get(this.$root.api + '/admin/reports/teachertrack').then((response) =>{
          console.log( response.body.data.labels);
          console.log(this.datacollection.labels);
          this.datacollection.labels = response.body.data.labels;
          // console.log(response.body.data.datasets[0].data);
          this.datacollection.datasets[0].label = response.body.data.datasets[0].label;
          this.datacollection.datasets[0].backgroundColor = response.body.data.datasets[0].backgroundColor;
          this.datacollection.datasets[0].data = response.body.data.datasets[0].data;
        })
        .then((error)=>{

        })
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>

<style>
  .small {
    /* max-width: 600px; */
    /* margin:  150px auto; */
    /* height: 100px; */
  }
</style>
