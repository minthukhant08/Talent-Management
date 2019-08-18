<template>
  <div>
        <section>
          <v-parallax src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="350" class="area">
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
            <v-layout
              column
              align-center
              justify-center
              class="white--text"
            >
              <!-- <h1 class="white--text mb-2 display-1 text-center">Parallax Template</h1>
              <div class="subheading mb-4 text-center">Powered by Vuetify</div> -->
              <v-btn
                class="mt-12"
                color="blue lighten-2"
                dark
                large
                @click='logout'
              >
                signe out
              </v-btn>
            </v-layout>
          </v-parallax>
        </section>

        <section>
          <v-layout
            column
            wrap
            class="my-12"
            align-center

          >
          <img class="logo elevation-7" src="https://scontent.frgn7-1.fna.fbcdn.net/v/t1.0-9/60349791_420506385196600_4899104598515515392_n.jpg?_nc_cat=107&_nc_oc=AQmdgEOrx_RDElzyjOlTglGOyBl93Hn89e_r0Z1wF0xq2xu_LxqQU_xaGMDTmV1eZqs&_nc_ht=scontent.frgn7-1.fna&oh=600c03d04a3865dbfe3b8903b35b597f&oe=5DD31FAB" alt="logo" height="200">

            <v-flex xs12>
              <v-container grid-list-xl>
                <v-layout row wrap align-center>
                  <v-flex xs12 md4>
                    <v-card class="elevation-0 transparent">
                      <v-card-text class="text-center">
                        <v-icon x-large class="success--text text--lighten-2">trending_up</v-icon>
                      </v-card-text>
                      <v-card-title primary-title class="layout justify-center">
                        <div class="headline">Don't wait for oppotunity</div>
                      </v-card-title>
                      <v-card-text>
                        This website detects the current location of visitors and show the relative search results depending on their location and
                        allows them to Explore subbed Anime with no extra steps.
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-card class="elevation-0 transparent">
                      <v-card-text class="text-center">
                        <v-icon x-large class="success--text text--lighten-2">trending_up</v-icon>
                      </v-card-text>
                      <v-card-title primary-title class="layout justify-center">
                        <div class="headline">Don't wait for oppotunity</div>
                      </v-card-title>
                      <v-card-text>
                        This website detects the current location of visitors and show the relative search results depending on their location and
                        allows them to Explore subbed Anime with no extra steps.
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-card class="elevation-0 transparent">
                      <v-card-text class="text-center">
                        <v-icon x-large class="info--text text--lighten-2">share</v-icon>
                      </v-card-text>
                      <v-card-title primary-title class="layout justify-center">
                        <div class="headline">Sharing is caring!</div>
                      </v-card-title>
                      <v-card-text>
                        This website detects the current location of visitors and show the relative search results depending on their location and
                        allows them to Explore subbed Anime with no extra steps.
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
          </v-layout>
        </section>

        <section>
          <v-parallax src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="380">
            <v-layout column align-center justify-center>
              <div class="headline white--text mb-4 text-center">Web development has never been easier</div>
              <em>Kick-start your application today</em>
              <v-btn
                class="mt-12"
                color="blue lighten-2"
                dark
                large
                @click='loginDialog()'
              >
                Get Started
              </v-btn>
            </v-layout>
          </v-parallax>
        </section>

        <section>
          <v-container grid-list-xl>
            <v-layout row wrap justify-center class="my-12">
              <v-flex xs12 sm4>
                <v-card flat class="transparent">
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Company info</div>
                  </v-card-title>
                  <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12 sm4 offset-sm1>
                <v-card flat class="transparent">
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Contact us</div>
                  </v-card-title>
                  <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                  </v-card-text>
                  <v-list class="transparent">
                    <v-list-item>
                      <v-list-item-action>
                        <v-icon class="blue--text text--lighten-2">mdi-phone</v-icon>
                      </v-list-item-action>
                      <v-list-item-content>
                        <v-list-item-title>777-867-5309</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-action>
                        <v-icon class="blue--text text--lighten-2">mdi-map-marker</v-icon>
                      </v-list-item-action>
                      <v-list-item-content>
                        <v-list-item-title>Chicago, US</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-action>
                        <v-icon class="blue--text text--lighten-2">mdi-email</v-icon>
                      </v-list-item-action>
                      <v-list-item-content>
                        <v-list-item-title>john@vuetifyjs.com</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>
        </section>
      </div>
</template>

<script>
import {bus} from '../../app';
import commonmethods from '../../mixins/commonMethods';
export default {
  mixins:[commonmethods],

  methods:{
    loginDialog(){
      bus.$emit('show_login');
    }
  }
}
</script>

<style>
::-webkit-scrollbar {
display: none;
}

.logo{
  position: absolute;top: 190px;
  z-index: 1;
  border: 5px solid #ffffff;
  border-radius: 10px;
}

.area{
    background: white;
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    /* width: 100%;
    height:100%; */
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    animation: animate 25s linear infinite;
    bottom: -180px;
    background: url('https://png.pngtree.com/svg/20161122/ad9afaac8b.svg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}

</style>
