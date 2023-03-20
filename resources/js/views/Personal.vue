<template>
  {{ personalData.value }}
</template>

<script lang="ts">
import {usePersonalDataStore} from "../store/personalDataStore";
import usePersonalData from "../composables/personalData";

export default {
  name: "Personal",
  setup: () => {
    const {personalData} = usePersonalData();
    console.log(personalData);
    return {personalData};
  }
}
</script>

<style scoped>

</style>
