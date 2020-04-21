<template>
  <div class="card" :title="$t('editObjet')">
    <div>
      <router-link :to="{ name: 'objets' , params: { id: siteId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Nom de l'objet</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            v-model="name"
            aria-describedby="emailHelp"
            placeholder="Nom de l'objet"
          />
        </div>
        <button type="submit" class="btn btn-warning">Modifier l'objet</button>
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
      siteId: 0,
      objetId: 0,
      sites: 0,
      name: ""
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/objets/" + this.objetId, {
        name: this.name,
        objetId: this.objetId,
        _method: "patch"
      });
    }
  },
  mounted() {
    axios.get("/api/objets/" + this.objetId).then(res => {
      this.name = res.data[0].name;
    });
  },
  created() {
    this.objetId = this.$route.params.id;
    this.siteId = this.$route.params.siteId;
  },
  metaInfo() {
    return { title: this.$t("Objets") };
  }
};
</script>
