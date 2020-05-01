<template>
  <div class="card" :title="$t('createObjet')">
    <div>
      <router-link :to="{ name: 'objets' , params: { id: siteId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Date de debut</label>
          <input
            type="date"
            class="form-control"
            id="date_debut"
            name="date_debut"
            v-model="date_debut"
            aria-describedby="emailHelp"
            placeholder="date debut"
          />
          <label for="exampleInputEmail1">Heure de debut</label>
          <input
            type="time"
            class="form-control"
            id="heure_debut"
            name="heure_debut"
            v-model="heure_debut"
            aria-describedby="emailHelp"
            placeholder="heure debut"
          />
        </div>
        <button type="submit" class="btn btn-primary">Commander le lavage</button>
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
      date_debut: "",
      heure_debut: "",
      objetId: 0,
      siteId: 0,
      clientId: 0
    };
  },
  methods: {
    submitForm() {
      axios.post("/api/commandes", {
        date_debut: this.date_debut + " " + this.heure_debut,
        clientId: this.clientId,
        objetId: this.objetId,
        status: "Commande"
      });
    }
  },
  created() {
    this.siteId = this.$route.params.siteId;
    this.objetId = this.$route.params.id;
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("Objets") };
  }
};
</script>