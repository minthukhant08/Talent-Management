<template>
      <div>
           <v-dialog
              v-model="dialog"
              width="500"
              height="500"

            >
              <v-card> 
                  <v-list three-line>
                       <template  v-for="comment in comments">
                          <v-subheader
                            v-if="comment.header"
                            :key="comment.header"
                            v-text="comment.header"
                          ></v-subheader>

                          <v-divider
                            v-else-if="comment.divider"
                            :key="comment"
                            :inset="comment.inset"
                          ></v-divider>

                          <v-list-item
                            v-else
                            :key="comment.title"
                            @click="detail"
                          >
                            <v-list-item-avatar>
                              <v-img :src="comment.avatar"></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                              <v-list-item-title v-html="comment.title"></v-list-item-title>
                              <v-list-item-subtitle v-html="comment.subtitle"></v-list-item-subtitle>
                            </v-list-item-content>
                    
                              </v-list-item>
                        </template>
                <v-text-field
                v-model="value"
                color="cyan darken"
                placeholder="Start typing..."
                loading
              >
                <template v-slot:progress>
                  <v-progress-linear
                    v-if="custom"
                    :value="progress"
                    :color="color"
                    absolute
                    height="7"
                  ></v-progress-linear>
                </template>
                </v-text-field>
              </v-list>
              
              </v-card>
            

            </v-dialog>
              <v-layout
                  row
                  wrap
                  v-for="card in cards"
                    :key="card.title"
                  pt-5
                  py-5

                >
                <v-flex lg2 ></v-flex>
                  <v-flex
                    lg8
                  >
                    <v-card>

                  
              <v-img 
                        :src="card.src"
                        
                        class="white--text"
                        max-height="300"
                        gradient="to bottom, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                      >
                        <v-card-title
                          class="fill-height align-end"
                        ><span class="my-span">
                          {{card.title}}
                  </span></v-card-title>
                      </v-img>

          <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn icon>
                          <v-icon>favorite</v-icon>
                        </v-btn>
                        <v-spacer> </v-spacer>

                        <v-btn icon @click="detail">
                          <v-icon>bookmark</v-icon>
                        </v-btn>
                              <v-spacer> </v-spacer>

                        <v-btn icon>
                          <v-icon>share</v-icon>
                        </v-btn>
                      </v-card-actions>
                      </v-card>

        </v-flex>
        <v-flex lg2 ></v-flex>
      </v-layout>
      </div>

</template>

// import Userview from '../User/UserView.vue';

  <script>
  export default {
    data: () => ({
      cards: [
        { title: 'How to be IT profession', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 12 },
        { title: 'Soft Skill', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 6 },
        { title: 'Smart person', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 6 },
      ],
        comments:[{ header: 'Today' },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title: 'Brunch this weekend?',
          subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title: 'Brunch this weekend?',
          subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title: 'Brunch this weekend?',
          subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title: 'Brunch this weekend?',
          subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
          title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
          subtitle: "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
          title: 'Oui oui',
          subtitle: "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
          title: 'Birthday gift',
          subtitle: "<span class='text--primary'>Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?",
        },
        { divider: true, inset: true },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
          title: 'Recipe to try',
          subtitle: "<span class='text--primary'>Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.",
        },
        









      ],
       dialog: false,
    }),

  methods:{

detail(){
     this.dialog = true;

}
  },


  



    
  }
  

</script>

