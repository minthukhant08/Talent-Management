<template>
  <v-container style="height:100%;">
    <v-layout
      align="center"
      justify="center"
      style="height: 100%;"
    >
      <v-card width="100%"class="pa-6">
        <v-switch v-model="people" label="Intake" value="John"></v-switch>
        <p>Google form</p>
        <v-text-field
            label="Link"
            color="#f57c00"
            outlined>
        </v-text-field>
        <div class="text-right">
          <v-btn color="#f57c00">Update</v-btn>
      </div>
      </v-card>
    </v-layout>
  </v-container>
</template>

<script>
export default {
    data () {
      return {
        people: ['John'],
      }
    },
  }
</script>
