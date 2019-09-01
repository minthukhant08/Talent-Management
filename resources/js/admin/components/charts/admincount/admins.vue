<template>
  <div class="small">
    <Doughnut :chart-data="datacollection"></Doughnut>
    <button @click="fillData()">Randomize</button>
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
                          labels: ['a', 'b'],
                          datasets: [
                          {
                            label: 'Light',
                            backgroundColor: [],
                            data: [],
                          },
                          ]
                        },
        AdminCountLabel:[],
        AdminCountData:[]
      }
    },
    created () {
      this.getAdminCount()
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: ['d', 'f'],
          datasets: [
            {
              label: ['d', 'f'],
              backgroundColor: ['blue', 'red'],
              data: [1,2]
            }
          ]
        }
        console.log('filled');
        console.log(this.datacollection);
      },
      getAdminCount(){

        this.$http.get(this.$root.api + '/admin/reports/admins').then((response) =>{
          this.datacollection.labels = response.body.data.labels;
          console.log(response.body.data.datasets[0].data);
          this.datacollection.datasets.label = response.body.data.datasets[0].label;
          this.datacollection.datasets[0].backgroundColor = response.body.data.datasets[0].backgroundColor;
          this.datacollection.datasets[0].data = response.body.data.datasets[0].data;
          console.log('api');
          console.log(this.datacollection);
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
