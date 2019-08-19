<template>
  <v-layout row>
    
    <v-flex xs0 sm0 md1 lg2 xl2> </v-flex>
    <v-flex xs12 sm12 md10 lg8 xl8>    
   <v-container style="height: calc(100% - 50px);">
      
       <v-card>
        
          <v-list two-line >
            <div class=" pl-5 headline">
            Results
            </div>
           <template v-for="result in results">
              <v-list-item
             :key="result.id">
      
               <v-list-item-content  >
                 <v-list-item-title class="blue--text">
                    <div class="title">
                     {{result.assignment.name}}
                    </div>
                 </v-list-item-title>
                 <div class="my-4"> 
                 </div>        

                <!-- <v-list-item-subtitle> -->
                  <!-- {{item.subtitle}}      -->
                <!-- </v-list-item-subtitle>  -->
                 </v-list-item-content>
           
            
             <v-list-item-action>
            
                <v-progress-circular
                    :rotate="90"
                    :size="100"
                    :width="9"

                 
                    :value="result.marks"
                    :color='progresscolor(result.marks)'
                  >
                    {{ result.marks }}
                </v-progress-circular>
              
            </v-list-item-action>
            </v-list-item>
            <v-divider green></v-divider>
          </template>
        </v-list>
      </v-card>
  </v-container>
</v-flex>
    <v-flex  xs0 sm0 md1 lg2 xl2>  </v-flex>

    </v-layout>
</template>
<script>
  export default {
    data: () => ({
      results: [
      
        
      ],
      
    }),
    
    methods:{
      progresscolor($mark) 
      {
        if ($mark <=20){
           return"#F44336";
        }
        else if ($mark<=40){
            return "#FF5722";
        }
        else if ($mark<=60){
            return "#FFEB3B";
        }
       else if ($mark<=80){
            return "#EEFF41";
        }
       else{
            return "#8BC34A";
       }

      },

      getall(){
      this.$http.get('http://localhost:9000/api/v1/results?student_id=3').then(response => {   
      console.log(response.body);
       this.results = response.body.data;
      }, response =>{

        });
      },








  
    },

created(){
     
      this.getall();
           },

         }









  
</script>








    
 















