<template>
  <v-container style="height: calc(100% - 50px);overflow-y: scroll; overflow-x:hidden;">
       <v-card style="">
      
        <v-list two-line>
          <v-subheader>Results</v-subheader>
          <template v-for="item in items">
            
            <v-list-item>
              <v-list-item-content>
              <v-text class="yellow--text">
               
                {{item.title}}
                </v-text>
    
                 <div class="my-4"> 
                </div>        

                <v-list-item-subtitle>
                  {{item.subtitle}}     
                </v-list-item-subtitle>   





                </v-list-item-content>
            <v-list-item-avatar>
                <v-progress-circular
                    :rotate="360"
                    :size="100"
                    :width="100"
                    :value="item.mark"
                    color="teal"
                  >
                    {{ item.mark }}
                



                </v-progress-circular>
              </v-list-item-avatar>
            </v-list-item>
            <v-divider green></v-divider>
          </template>
        </v-list>
      </v-card>
  </v-container>
</template>

 <style scoped>
             .v-progress-circular {
             margin: 10rem;
}
</style>




<script>
  export default {
    data: () => ({
      items: [
        { avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg', title: 'Assignment1', subtitle: "Ali Connors I'll be in your neighborhood doing errands this weekend. Do you want to hang out?", mark:30 },
        { avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg', title: 'Assignment2 ', subtitle: "to Alex, Scott, Jennifer Wish I could come, but I'm out of town this weekend.", mark: 50 },
        { avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg', title: 'Assignment3', subtitle: "Sandra Adams Do you have Paris recommendations? Have you ever been?", mark: 60 },
         { avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg', title: 'Assignment1', subtitle: "Ali Connors I'll be in your neighborhood doing errands this weekend. Do you want to hang out?", mark:30 },
        { avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg', title: 'Assignment2 ', subtitle: "to Alex, Scott, Jennifer Wish I could come, but I'm out of town this weekend.", mark: 50 },
        { avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg', title: 'Assignment3', subtitle: "Sandra Adams Do you have Paris recommendations? Have you ever been?", mark: 60 },
         { avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg', title: 'Assignment1', subtitle: "Ali Connors I'll be in your neighborhood doing errands this weekend. Do you want to hang out?", mark:30 },
        
      ],
      
    }),
  }
</script>











    
 















