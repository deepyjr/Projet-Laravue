<template>
  <div class="card" :title="$t('IndexCampus')">
    <div>
      <router-link :to="{ name: 'campus' }" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p>Êtes-vous sûr de vouloir supprimer ce campus définitivement ?</p>
        <button class="btn btn-danger" @click="confirmDelete">Supprimer le campus</button>
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
      campus: [],
      confirmDelete: 0
    };
  },
  methods: {
    confirmDelete() {
      axios.delete("/api/campus/" + this.campusId);
    }
  },
  created() {
    this.campusId = this.$route.params.id;
  },
  mounted() {},
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
