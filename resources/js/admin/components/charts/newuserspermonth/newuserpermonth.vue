<template>
  <div class="small">
    <line-chart :chart-data="datacollection"></line-chart>
  </div>
</template>

<script>
  import LineChart from './../linechart.js'
  export default {
    components: {
      LineChart
    },
      props: {'data1':Array, 'data2':Array, 'myheight':Number},
    data () {
      return {
        datacollection: {
                          labels: ['a', 'b'],
                          datasets: [
                          {
                            label: '2018',
                            backgroundColor: [],
                            data: [],
                          },
                          {
                            label: '2019',
                            backgroundColor: [],
                            data: [],
                          }
                          ]
                        },
      }
    },
    mounted () {
      this.getCount()
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
      getCount(){

        this.$http.get(this.$root.api + '/admin/reports/eachmonth?first_year=2018&second_year=2019').then((response) =>{
          this.datacollection.labels = response.body.data.labels;
          this.datacollection.datasets = response.body.data.datasets;
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
