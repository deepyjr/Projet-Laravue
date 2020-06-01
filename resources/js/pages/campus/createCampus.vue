<template>
  <div class="card" :title="$t('IndexCampus')">
    <div class="container mt-5 mb-5">
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
          <div class="d-flex justify-content-end  mt-2">
            <router-link :to="{ name: 'sites' , params: { id: campusId }}" class="btn btn-primary">Retour</router-link>
            <button type="submit" class="btn btn-primary ml-3">Créer le nouveau campus</button>
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
      adress: "",
      campus: [],
      campusId: 1,
      clientId: 0
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/campus", {
        name: this.name,
        adress: this.adress,
        clientId: this.clientId
      });
    }
  },
  mounted() {
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
