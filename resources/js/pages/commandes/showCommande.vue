<template>
  <div class="card" :title="$t('showCommande')">
    <div>
      <router-link
        :to="{ name: 'commandes' , params: { clientId: clientId }}"
        class="btn btn-primary"
      >Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p class="card-text">Description: {{ commande.description }}</p>
      </div>
      <div class="card-body">
        <p class="card-text">status: {{ commande.status }}</p>
      </div>
      <div class="card-body">
        <p class="card-text">Commandé le: {{ commande.date_commande }}</p>
      </div>
      <div class="card-body">
        <p class="card-text">Début du lavage: {{ commande.date_debut }}</p>
      </div>
      <div class="card-body">
        <p class="card-text">Lavage fini le : {{ commande.date_fin }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  resource: null,
  data() {
    return {
      commandeId: 0,
      commande: [],
      clientId: 0
    };
  },
  methods: {},
  created() {
    this.commandeId = this.$route.params.id;
    this.clientId = this.$route.params.clientId;
  },
  mounted() {
    axios.get("/api/commandes/" + this.commandeId).then(res => {
      this.commande = res.data;
    });
  },
  metaInfo() {
    return { title: this.$t("Commandes") };
  }
};
</script>
