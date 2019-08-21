
<template>
  <v-card
    max-width="850"
    class="mx-auto"
    height="100%"

  >

          <v-dialog
           v-model="modal"

           full-width
           width="290px"
         >

             <v-date-picker v-model="date" :readonly='true' :show-current="false"></v-date-picker>
         </v-dialog>


    <v-list three-line>
      <template v-for="(item, index) in items" >
        <v-subheader

          v-on="on"
          v-if="item.header"
          :key="item.header"
          v-text="item.header"

        ></v-subheader>





        <v-list-item
           :key="item.id"
          @click.stop="showDate(item.subtitle)"

         >
                <v-list-item-avatar>
                  <v-img :src="item.avatar"></v-img>
                </v-list-item-avatar>
              <v-list-item-content >
              <v-list-item-title v-html="item.title" ></v-list-item-title>
              <v-list-item-subtitle>{{convert(item.subtitle)}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
          <v-divider></v-divider>
      </template>
    </v-list>
  </v-card>
</template>

<script>


  export default {
    data: () => ({
      readonly: false,
      date: '',
      modal:false,
      items: [

        {
          id: '1',
          avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
          title: "Front-End",
          subtitle:'2013-07-09' ,
          color: "orange",
        },
        {
          id: '2',
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title:"SCSS-BEM",
          subtitle:'2013-07-02',
          color: "orange",
        },
        {
          id: '3',
          avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
          title: "SCSS-BEM",
          subtitle:'2013-07-07' ,
          color: "orange",

        },
        {
          id: '4',
          avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
          title:"Git" ,
          subtitle: '2013-07-29',
          color: "orange",
        },
        

      ],
    }),
    methods:{
      showDate(date){
        this.modal = true;
        this.date = date;
      },
      convert(date){
        return new Date(date).toISOString().substr(0, 10);
      }
    }
  }





</script>
