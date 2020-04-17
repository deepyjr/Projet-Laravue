<template>
  <div class="card" :title="$t('createObjet')">
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
            placeholder="Nom du sites"
          />
        </div>
        <button type="submit" class="btn btn-primary">Créer le nouvel objet</button>
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
      siteId: 1
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/objets", {
        name: this.name,
        siteId: this.siteId,
        clientId: 1 //TODO cahnger clientId
      });
    }
  },
  created() {
    this.siteId = this.$route.params.siteId;
  },
  metaInfo() {
    return { title: this.$t("Objets") };
  }
};
</script>
