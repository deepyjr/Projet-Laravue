<template>
  <div class="card" :title="$t('deleteObjet')">
    <div>
      <router-link :to="{ name: 'objets' , params: { id: siteId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p>Êtes-vous sûr de vouloir supprimer cet objet définitivement ?</p>
        <button class="btn btn-danger" @click="confirmDeleteObjet">Supprimer l'objet</button>
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
      objetId: 0,
      confirmDelete: 0,
      siteId: 0
    };
  },
  methods: {
    confirmDeleteObjet() {
      axios.delete("/api/objets/" + this.objetId);
    }
  },
  created() {
    this.siteId = this.$route.params.siteId;
    this.objetId = this.$route.params.id;
  },
  mounted() {},
  metaInfo() {
    return { title: this.$t("Objet") };
  }
};
</script>
