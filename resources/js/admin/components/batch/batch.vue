<template>

<v-layout row ma-3>

  <v-flex xs0 sm0 md2 lg2 xl2>

  </v-flex>

  <v-flex xs12 sm12 md8 lg8 xl8>

  <template>
    <v-card class="mt-3">
    <v-card-title>
      Batch
      <v-spacer></v-spacer>
      <v-btn color="accent" dark v-on="on"><v-icon>add</v-icon></v-btn>

    </v-card-title>

    <v-simple-table height="auto" weight="100%">

      <thead>
        <tr>
          <th class="text-left">Name</th>
          <th class="text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in desserts" :key="item.name">
          <td>{{ item.name }}</td>
          <td>
            <v-icon @onclick="dialog"
            >delete
            </v-icon>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </v-card>
  </template>

  </v-flex>

  <v-flex xs12 sm12 md2 lg2 xl2>

  </v-flex>

</v-layout>
</template>
<script>
  export default {
    data () {
      return {
        desserts: [
          {
            name: 'Batch(1)',
            calories: 159,
          },
          {
            name: 'Batch(2)',
            calories: 237,
          },

        ],
      }
    },
  }
</script>
