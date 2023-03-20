<template>
  <div class="d-flex align-center justify-center" style="height: 100vh">
    <v-sheet width="400" class="mx-auto">
      <v-form fast-fail @submit.prevent="login">
        <v-text-field variant="outlined" v-model="email" label="email"/>
        <v-text-field variant="outlined" v-model="password" label="password"/>
        <router-link to="password_recovery" class="text-body-2 font-weight-regular">Forgot password?
        </router-link>
        <v-btn type="submit" color="primary" block class="mt-2">Sign in</v-btn>

      </v-form>
      <div class="mt-2">
        <p class="text-body-2">Don't have an account?
          <router-link to="register">Sign Up</router-link>
        </p>
      </div>
    </v-sheet>
  </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from 'vue';
import api from '../axios'
import {useRouter} from "vue-router";

export default defineComponent({
  name: "Login",
  setup: () => {
    let email = ref(null)
    let password = ref(null);

    const router = useRouter();

    const login = async () => {
      api.post('/auth/login', {
        email: email.value,
        password: password.value
      }).then((res) => {
        if (res.status === 200) {
          localStorage.setItem('access_token', res.data.access_token)
          router.push({name: 'personal'})
        }
      })
    };

    return {email, password, login};
  }
});
</script>

<style scoped>

</style>
