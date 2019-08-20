<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-layout>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
          <v-flex xs12 sm12 md10 lg10 xl10>
            <v-card class="mt-3">
              <v-card-title>
                Activity
                <v-spacer></v-spacer>
                <v-btn color="accent" dark v-on="on"><v-icon>add</v-icon></v-btn>

              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="desserts"
                :search="search"
              ></v-data-table>
            </v-card>
          </v-flex>
          <v-flex xs0 sm0 md1 lg1 xl1></v-flex>
        </v-layout>

      </template>
      <v-card>
        <v-card-title>
          <span class="headline">User Profile</span>
        </v-card-title>
          <v-layout row ma-3>
            <v-flex xs12 sm12 md5 lg5 xl5>
              <v-col align="center" justify="center">
                <v-img
                  src="https://picsum.photos/id/11/500/300"
                  lazy-src="https://picsum.photos/id/11/10/6"
                  aspect-ratio="1"
                  class="grey lighten-2"
                  max-width="200"
                  max-height="200"
                ></v-img>
            </v-col>
            </v-flex>
            <v-flex xs12 sm12 md7 lg7 xl7>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      <v-text>Name</v-text>
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      <v-text>Speaker</v-text>
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      <v-text>Date</v-text>
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      <v-text>Type</v-text>
                    </v-col>
                    <v-col xs12 sm12 md7 lg7 xl7>
                      <v-text-field
                        filled
                        color="accent"
                        ></v-text-field>
                    </v-col>
                  </v-row>
                </v-flex>
          </v-layout>
          <v-text>Description</v-text>
          <v-textarea
                outlined
                label="Outlined textarea"
          ></v-textarea>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="dialog = false">Post</v-btn>
          </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
  export default {
    data: () => ({
      dialog: false,
        headers: [
          {
            text: 'Dessert ',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' },
        ],
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
          },
        ],
    }),
  }
</script>
<style lang="sass">
  .customActivityForm.row
    height: 55px
    .col
        height: 55px
    .v-text-field
      padding-top: 0
      margin-top: 0
    .v-text-field--filled>.v-input__control>.v-input__slot
      max-height: 30px !important
      min-height: 0 !important

    .v-text-field--filled input
      margin-top: 0

</style>
