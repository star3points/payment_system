import {defineStore} from "pinia";
import usePersonalData from "../composables/personalData";

export const usePersonalDataStore = defineStore("personalData", usePersonalData);