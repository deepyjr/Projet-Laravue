<template>
  <div class="card" :title="$t('showSite')">
    <div>
      <router-link :to="{ name: 'sites' , params: { id: campusId }}" class="btn btn-primary">Retour</router-link>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p class="card-text">Nom: {{ site.name }}</p>
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
      siteId: 0,
      site: [],
      campusId: 0
    };
  },
  methods: {},
  created() {
    this.siteId = this.$route.params.id;
    this.campusId = this.$route.params.campusId;
  },
  mounted() {
    axios.get("/api/sites/" + this.siteId).then(res => {
      this.site = res.data[0];
    });
  },
  metaInfo() {
    return { title: this.$t("Sites") };
  }
};
</script>
