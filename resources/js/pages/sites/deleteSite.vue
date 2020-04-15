<template>
  <div class="card" :title="$t('deleteSite')">
    <div>
      <router-link :to="{ name: 'sites' , params: { id: campusId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p>Êtes-vous sûr de vouloir supprimer ce site définitivement ?</p>
        <button class="btn btn-danger" @click="confirmDeleteSite">Supprimer le site</button>
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
      campusId: 0,
      confirmDelete: 0,
      siteId: 0
    };
  },
  methods: {
    confirmDeleteSite() {
      axios.delete("/api/sites/" + this.siteId);
    }
  },
  created() {
    this.campusId = this.$route.params.campusId;
    this.siteId = this.$route.params.id;
  },
  mounted() {},
  metaInfo() {
    return { title: this.$t("Sites") };
  }
};
</script>
