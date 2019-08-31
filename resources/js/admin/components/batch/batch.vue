<template>

<v-layout row ma-3>

  <v-flex xs0 sm0 md1 lg1 xl1>

  </v-flex>

  <v-flex xs12 sm12 md10 lg10 xl10>

    <v-card class="mt-3" :elevation="5">
    <v-card-title>
      Batch
      <v-spacer></v-spacer>
      <v-text-field
      v-model="search"
      append-icon="search"
      label="Search"
      single-line
      hide-details
    ></v-text-field>
      <v-btn color="accent" class="elevation-5" @click="dialog=true"><v-icon>add</v-icon></v-btn>
      <v-dialog
        v-model="dialog"
        width="500"
      >
        <v-card>
          <v-card-title

            class="headline accent lighten-2"
            primary-title
          >
            Add Batch
          </v-card-title>

          <v-layout row ma-3>
            <v-flex xs12 sm12 md12 lg12 xl12>
                  <v-row class="customActivityForm">
                    <v-col xs12 sm12 md3 lg3 xl3>
                      Name
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
                      Start Date
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
                      End Date
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

          <v-divider></v-divider>

          <v-card-actions>
            <div class="flex-grow-1"></div>
            <v-btn
              color="accent"
              text
              @click="detail = false"
            >
              POST
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card-title>

      <v-data-table
        :headers="headers"
        :items="batch"
        :items-per-page="5"
        :search="search"
      >
      <template v-slot:item.action="{ item }">
        <v-btn color="error"
        @click="deleteBatch(item)"
          small
        ><v-icon>delete</v-icon>

        </v-btn>
      </template>

    </v-data-table>

  </v-card>

  </v-flex>

  <v-flex xs12 sm12 md1 lg1 xl1>

  </v-flex>

</v-layout>
</template>
<script>
  export default {
    data () {
      return {
        dialog:false,
        search:'',
        headers: [
          {
            text: 'Batch',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          {
            text: 'Start Date',
            align: 'left',
            sortable: false,
            value: 'start_date',
          },
          {
            text: 'End Date',
            align: 'left',
            sortable: false,
            value: 'end_date',
          },
          {
            text: 'Actions',
            value: 'action',
            align: 'right',
            sortable: false },
        ],
        batch:[],
      }
    },
    computed:{
      Admin(){
        return this.$store.getters.getAdmin;
      }
    },
    methods: {
      deleteBatch (batch) {
        const index = this.batch.indexOf(batch);
        this.batch.splice(index, 1);
        this.$http.put(this.$root.api + '/batches/delete/'+ batch.id,{
          admin_id: this.Admin.id
        },
        {
          headers: {
            Authorization: 'Bearer ' + this.Admin.token
          }
        }).then((response) =>{
          console.log(response);
          this.batch.splice(index, 1);
        })
      },
      getbatch(){
        this.$http.get(this.$root.api + '/batches',{
          headers: {
              Authorization: 'Bearer '+ this.Admin.token
          }
        }).then(response=>{
          this.batch= response.body.data;
          console.log(this.batch);
        }, response => {
          console.log('error');
        })
      },
    },
    created(){
      this.getbatch()
    }
  }
</script>
