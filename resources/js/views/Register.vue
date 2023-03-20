<template>
  <div class="d-flex align-center justify-center" style="height: 100vh">
    <v-sheet width="400" class="mx-auto">
      <v-form fast-fail @submit.prevent="register">
        <v-text-field variant="outlined" v-model="name" label="Name"></v-text-field>
        <v-text-field variant="outlined" v-model="email" label="Email"></v-text-field>
        <v-text-field variant="outlined" v-model="phone" label="Phone"></v-text-field>

        <v-text-field variant="outlined" v-model="password" label="password"></v-text-field>
        <v-text-field variant="outlined" v-model="confirmPassword" label="confirm password"></v-text-field>

        <v-btn type="submit" color="primary" block class="mt-2">Sign in</v-btn>

      </v-form>
      <div class="mt-2">
        <div class="mt-2">
          <p class="text-body-2">Already have an account?
            <router-link to="login">Sign In</router-link>
          </p>
        </div>
      </div>
    </v-sheet>
  </div>
</template>

<script lang="ts">
import {ref} from "vue";
import api from '../axios'

export default {
  name: "Register",
  setup: () => {
    const name = ref(null);
    const email = ref(null);
    const phone = ref(null);
    const password = ref(null);
    const confirmPassword = ref(null);

    const register = async () => {
      api.post('/auth/register', {
        name: name.value,
        email: email.value,
        phone: phone.value,
        password: password.value,
      }).then((res) => {
        console.log(res);
      })
    };
    return {name, email, phone, password, confirmPassword};
  }
}
</script>

<style scoped>

</style>
