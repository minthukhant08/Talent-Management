<template>
  <div class="small">
    <line-chart :height="this.myheight" :chart-data="datacollection"></line-chart>
    <button @click="fillData()">Randomize</button>
  </div>
</template>

<script>
  import LineChart from './linechart.js'

  export default {
    components: {
      LineChart
    },
      props: {'data1':Array, 'data2':Array, 'myheight':Number},
    data () {
      return {
        datacollection: null
      }
    },
    created () {
      this.fillData()
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
