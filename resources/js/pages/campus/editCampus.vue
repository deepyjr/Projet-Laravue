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
        <button type="submit" class="btn btn-warning">Modifier le campus</button>
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
      campusId: 0,
      campus: [],
      name: "",
      adress: ""
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/campus/" + this.CampusId, {
        name: this.name,
        adress: this.adress,
        campusId: this.campusId,
        _method: "patch"
      });
    }
  },
  mounted() {
    axios.get("/api/campus/" + this.campusId).then(res => {
      this.name = res.data[0].name;
      this.adress = res.data[0].adress;
    });
  },
  created() {
    this.campusId = this.$route.params.id;
  },
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
