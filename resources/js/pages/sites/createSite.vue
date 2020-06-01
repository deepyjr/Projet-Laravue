<template>

  <div class="card" :title="$t('createSite')">
      <div class="container mt-5 mb-5">
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
          <div class="d-flex justify-content-end  mt-2">
            <router-link :to="{ name: 'sites' , params: { id: campusId }}" class="btn btn-primary">Retour</router-link>
            <button type="submit" class="btn btn-primary ml-3">Créer le nouveau site</button>
          </div>
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
        clientId: 0
      });
    }
  },
  created() {
    this.campusId = this.$route.params.campusId;
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("Sites") };
  }
};
</script>

<style  scoped>
.textRetour{
  text-decoration: none !important;
  color: #3497DC !important;
}
</style>
