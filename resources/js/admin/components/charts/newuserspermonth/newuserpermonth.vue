<template>
  <div class="small">
    <line-chart :chart-data="datacollection"></line-chart>
    <button @click="fillData()">Randomize</button>
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
                            label: 'Light',
                            backgroundColor: [],
                            data: [],
                          },
                          {
                            label: 'Dark',
                            backgroundColor: [],
                            data: [],
                          }
                          ]
                        },
      }
    },
    created () {
      this.getCount()
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      }
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: this.data1,
          datasets: [
            {
              label: this.data1[0],
              backgroundColor: 'blue',
              data: [this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()]
            }, {
              label: this.data2[1],
              backgroundColor: '#f87979',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
            }
          ]
        }
      },
      getCount(){

        this.$http.get(this.$root.api + '/admin/reports/eachmonth').then((response) =>{
          console.log('newgg');
          console.log(response.body.data);
          this.datacollection.labels = response.body.data.labels;
          console.log(response.body.data.datasets[0].data);
          this.datacollection.datasets.label = response.body.data.datasets[0].label;
          this.datacollection.datasets[0].backgroundColor = response.body.data.datasets[0].backgroundColor;
          this.datacollection.datasets[0].data = response.body.data.datasets[0].data;
          console.log('new user');
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
