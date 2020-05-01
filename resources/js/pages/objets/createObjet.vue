<template>
  <div class="card" :title="$t('createObjet')">
    
    <div class="container mt-5 mb-5">
      
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
        <div class="d-flex justify-content-end  mt-2">
          <router-link :to="{ name: 'objets' , params: { id: siteId }}" class=" btn btn-primary "> <i class="fa-long-arrow-alt-left"></i> Retour</router-link>
          <button type="submit" class="btn btn-primary ml-3">Créer le nouvel objet</button>
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
      siteId: 1
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/objets", {
        name: this.name,
        siteId: this.siteId,
        clientId: 0
      });
    }
  },
  created() {
    this.siteId = this.$route.params.siteId;
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("Objets") };
  }
};
</script>
<style >
.textRetour{
  text-decoration: none !important;
  color: #3497DC !important;
}
</style>