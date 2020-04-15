<template>
  <div class="card" :title="$t('editSite')">
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
            placeholder="Nom du site"
          />
        </div>
        <button type="submit" class="btn btn-warning">Modifier le site</button>
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
      sites: 0,
      campus: [],
      name: ""
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/sites/" + this.sitesId, {
        name: this.name,
        siteId: this.siteId,
        _method: "patch"
      });
    }
  },
  mounted() {
    axios.get("/api/sites/" + this.siteId).then(res => {
      this.name = res.data[0].name;
    });
  },
  created() {
    this.siteId = this.$route.params.id;
    this.campusId = this.$route.params.campusId;
  },
  metaInfo() {
    return { title: this.$t("Sites") };
  }
};
</script>
