<template>
  <div class="card" :title="$t('deleteCommande')">
    <div>
      <router-link
        :to="{ name: 'commandes' , params: { clientId: clientId }}"
        class="btn btn-primary"
      >Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p>Êtes-vous sûr de vouloir supprimer cette commande définitivement ?</p>
        <button class="btn btn-danger" @click="confirmDeleteCommande">Supprimer la commande</button>
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
      clientId: 0,
      confirmDelete: 0,
      commandeId: 0
    };
  },
  methods: {
    confirmDeleteCommande() {
      axios.delete("/api/commandes/" + this.commandeId);
    }
  },
  created() {
    this.clientId = this.$route.params.clientId;
    this.commandeId = this.$route.params.id;
  },
  mounted() {},
  metaInfo() {
    return { title: this.$t("Commandes") };
  }
};
</script>
