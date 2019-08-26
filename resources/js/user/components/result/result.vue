<template>
  <!-- <v-layout row>
    <v-flex xs0 sm0 md1 lg2 xl2>
    </v-flex>
    <v-flex xs12 sm12 md10 lg8 xl8>
      <v-container style="height: calc(100% - 50px);">
        <v-card style="border:1px solid red;">
          <v-item v-slot:default="{ active, toggle }">
            <v-card
              :color="active ? 'primary' : ''"
              dark
              height="200"
              @click="toggle"
              style="border:1px solid blue;"
            >
            <v-flex xs12 sm12 md12 lg12 xl12 >
              <v-layout>
            <v-flex xs8 sm8 md8 lg8 xl8 class="pl-10 pt-5">
              Total Result
                 <div class=" pl-5  headline text-left">
              {{total}}
            </div>
            </v-flex>
            <v-flex xs8 sm8 md4 lg2 xl2 class="ml-10  headline right pt-5">
              Overall Grade <br> <br>
            {{grade}}
            </v-flex>

      




        </v-layout>
            
            
            <div class=" pl-10 my-2 text-left">
              Average
            </div>
            
             <div class=" pl-12 my-1 headline text-left">
              {{average}}
            </div>
            </v-flex>
            </v-card>
          </v-item>
         </v-card>
         <v-card>
<v-list two-line >
 
            <div class=" pl-5 headline">
              Results
            </div>
           <template v-for="result in results">
              <v-list-item :key="result.id" three-line>
                 <v-list-item-content  >
                  <v-card> 
                  <v-item-group>
    
              </v-item-group>
                  </v-card>  
                     <v-list-item-title class="blue--text">
                        <div class="pl-0 title" >
                         {{result.assignment.name}}
                        </div>
                     </v-list-item-title>
                  <v-list-item-subtitle>
                    {{result.comments}}
                  </v-list-item-subtitle>
                  </v-list-item-content>
                  <v-list-item-action>
                    <v-progress-circular
                        :rotate="90"
                        :size="100"
                        :width="11"
                        :value="result.marks"
                        :color='progresscolor(result.marks)'
                      >
                        {{ result.marks }}
                    </v-progress-circular>
                  </v-list-item-action>
              </v-list-item>
              <v-divider class="green"></v-divider>
            </template>
          </v-list>
        </v-card>
      </v-container>
    <!-- </v-flex>

    <v-flex  xs0 sm0 md1 lg2 xl2>
    </v-flex>
  </v-layout> -->
</template>
<script>
  export default {
    data(){
      return{
        results:[],
        avg:0,
      }
    },
    computed:{
      User(){
        return this.$store.getters.getUser;
      },
      grade(){
          if(this.average <= 40) {
            return "Grade C";
          }else if (this.average <= 70){
              return "Grade B";
            }else{
              return "Grade A";
          }
      },
      total(){
        return this.results.length;
      },
      average(){
        var total_marks=0;
        console.log(this.results);
        for(var i=0; i <= this.results.length -1; i++){
            total_marks = this.results[i].marks + total_marks;
        }
        this.avg = (total_marks / this.results.length);
        return this.avg;
      },
    },
    methods:{
      progresscolor(mark)
      {
          if (mark <= 20){
             return"#F44336";
          }else if (mark <= 40){
             return "#FF5722";
          }else if (mark<= 60){
             return "#FFEB3B";
          }else if (mark <= 80){
             return "#EEFF41";
          }else{
             return "#8BC34A";
         }
      },

    getall(){
      this.$http.get('http://localhost:9000/api/v1/results?student_id=' + this.User.id).then(response => 
        console.log(response.body);
          this.results = response.body.data;
          console.log(response.body.data);
        }, response =>{

        });
      }
    },

  created(){
    this.getall();
  }
}
</script>
