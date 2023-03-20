import axios from "../axios"
import {ref} from "vue";

export default async function usePersonalData() {
    const personalData = ref({});
    const getPersonalData = async () => {
        const res = await axios.post('/auth/me');
        personalData.value = res.data;
    };
    await getPersonalData();
    return {personalData};
}