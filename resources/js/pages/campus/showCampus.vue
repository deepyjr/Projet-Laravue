<template>
  <div class="card" :title="$t('IndexCampus')">
    <div>
      <router-link :to="{ name: 'campus' }" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p class="card-text">Nom: {{ campus.name }}</p>
        <p class="card-text">Adresse: {{ campus.adress }}</p>
      </div>
      <div>
        <a href class="btn btn-warning">Modifier</a>
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
      campus: []
    };
  },
  methods: {},
  created() {
    this.campusId = this.$route.params.id;
  },
  mounted() {
    axios.get("/api/campus/" + this.campusId).then(res => {
      this.campus = res.data[0];
    });
  },
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
