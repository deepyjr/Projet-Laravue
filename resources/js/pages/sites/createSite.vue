<template>
  <div class="card" :title="$t('createSite')">
    <div>
      <router-link :to="{ name: 'sites' , params: { id: campusId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Nom du site</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            v-model="name"
            aria-describedby="emailHelp"
            placeholder="Nom du sites"
          />
        </div>
        <button type="submit" class="btn btn-primary">Créer le nouveau site</button>
      </form>
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
      campusId: 1
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/sites", {
        name: this.name,
        campusId: this.campusId,
        clientId: 1 //TODO cahnger clientId
      });
    }
  },
  created() {
    this.campusId = this.$route.params.campusId;
  },
  metaInfo() {
    return { title: this.$t("Sites") };
  }
};
</script>
