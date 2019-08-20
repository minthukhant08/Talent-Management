<template>
  <v-card>
    <v-card-title>
      Course
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <template>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
          <v-dialog v-model="dialog" max-width="500px">
            <v-card>
              <v-card-title>
                <span class="headline">Course Detail</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text>TimeTable</v-text>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text>Description</v-text>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="blue darken-1" @click="close()">Exit</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

      </template>
      <template v-slot:item.action="{ item }">
        <v-btn
        color="green"
          small
          class="mr-2"
          @click="detail(item)"
        >
          Details
        </v-btn>
        <v-action >
        <v-btn color="blue"
        @click="goRoute('/admin/courseedit')"
          small
        >
          Edit
        </v-btn>
        </v-action>
      </template>

    </v-data-table>
  </template>

  </v-card>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Image',
          align: 'left',
          sortable: false,
          value: 'img',
        },
        { text: 'Name', value: 'name' },

        { text: 'Actions', value: 'action', sortable: false },
      ],
      desserts: [],

    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.desserts = [
          {
            name: 'Frozen Yogurt',
          },
        ]
      },

      detail (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>
