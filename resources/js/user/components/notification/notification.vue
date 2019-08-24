<template>
      <v-card class="pr-5">
        <v-list three-line>
          <template v-for="item in Notifications">
            <v-list-item>
              <v-list-item-avatar
              size="50"
              class="mr-3 ml-2"
              >
                <v-icon size=30 color=info v-if='item.type == "Info"'>info</v-icon>
                <v-icon size=30 color=warning v-if='item.type == "Confirmation"'>confirmation_number</v-icon>
                <v-icon size=30 color=success v-if='item.type == "Offer"'>local_offer</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{item.title}}</v-list-item-title>
                <v-list-item-subtitle>{{item.descriptions}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-divider inset></v-divider>
          </template>
        </v-list>
        <v-card-actions v-if="Notifications.length == 0" class="justify-center" >
          No Notification Available
        </v-card-actions>
      </v-card>
</template>

<script>
import commonmethods from '../../mixins/commonMethods';
export default {
  mixins:[commonmethods],
  computed:{
    Notifications(){
      return this.$store.getters.getNoti;
    },
  }

}
</script>
