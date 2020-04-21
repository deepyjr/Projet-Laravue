<template>
  <div class="card" :title="$t('IndexCampus')">
    <div>
      <router-link :to="{ name: 'campus' }" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Nom du campus</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            v-model="name"
            aria-describedby="emailHelp"
            placeholder="Nom du campus"
          />
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Adresse du campus</label>
          <input
            type="text"
            id="adress"
            v-model="adress"
            name="adress"
            class="form-control"
            placeholder="Adresse du campus"
          />
        </div>
        <button type="submit" class="btn btn-primary">Créer le nouveau campus</button>
      </form>
      <p>{{ campus }}</p>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  resource: null,
  data() {
    return {
      name: "",
      adress: "",
      campus: [],
      campusId: 1
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/campus", {
        name: this.name,
        adress: this.adress,
        clientId: 1 //TODO cahnger clientId
      });
    }
  },
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
