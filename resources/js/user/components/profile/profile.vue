<template>
  <div>
    <v-layout>

      <v-flex xs0 sm0 md1 lg1 xl1>
      </v-flex>

      <v-flex xs12 sm12 md10 lg10 xl10>
          <v-layout row ma-3>

            <v-flex xs12 sm12 md4 lg4 xl4>
              <div class="text-center">
                <v-avatar size="80" >
                  <img src="https://vuetifyjs.com/apple-touch-icon-180x180.png" alt="avatar">
                </v-avatar>
              </div>
            </v-flex>

            <v-flex xs12 sm12 md8 lg8 xl8>
              <span>Min Thu Khant</span></br>
              <span>minthu@gmail.com</span>
            </v-flex>

            <v-flex xs12 sm12 md12 lg12 xl12>
              <v-layout col>
                  <v-flex xs3 sm3 md3 lg3 xl3>
                    Addresssds
                  </v-flex>

                  <v-flex xs9 sm9 md9 lg9 xl9>
                    : sdfdsfdsfsdf
                  </v-flex>
                  <v-flex xs3 sm3 md3 lg3 xl3>
                    Addresssds
                  </v-flex>

                  <v-flex xs9 sm9 md9 lg9 xl9>
                    : sdfdsfdsfsdf
                  </v-flex>
                  <v-flex xs3 sm3 md3 lg3 xl3>
                    Addresssds
                  </v-flex>

                  <v-flex xs9 sm9 md9 lg9 xl9>
                    : sdfdsfdsfsdf
                  </v-flex>

              </v-layout>
            </v-flex>

          </v-layout>
          <v-card
            max-width="344"
            class="mx-auto"
            v-for="(card, index) in cards"
            :key="index"
          >
            <v-card-title>{{card.title}}</v-card-title>
            <v-card-text>{{card.text}}</v-card-text>
            <v-card-actions>
              <v-btn @click='showDialog'>Click</v-btn>
            </v-card-actions>
          </v-card>
      </v-flex>

      <v-flex xs0 sm0 md1 lg1 xl1>
      </v-flex>

    </v-layout>
    <v-dialog v-model="dialog" persistent>
      <v-card
        class="mx-auto"
      >
        <v-card-title>Dialog</v-card-title>
        <v-card-text>sdfsdfsdfsdf</v-card-text>
        <v-card-actions>
          <v-btn @click='dialog=false'>Click</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default{
  data(){
    return{
      cards:[{title:'title1', text:'something'},
            {title:'title2', text:'sdfdsf'},
            {title:'title2', text:'sdfdsf'},
            {title:'title2', text:'sdfdsf'},
            {title:'title2', text:'sdfdsf'}
          ],
      dialog:false
    }
  },
  methods:{
    showDialog(){
      this.dialog = true;
    }
  }
}
</script>
