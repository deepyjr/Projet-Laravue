<template>
  <div class="card" :title="$t('IndexCommandes')">
    <div class="card-content">
      <div class="content">
        <table class="table is-hoverable">
          <thead>
            <tr>
              <th>#</th>
              <th>commandes</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(commande, index) in commandes" v-bind:key="index">
              <td>{{ commande.id }}</td>
              <td>
                <strong>{{ commande.description }}</strong>
              </td>
              <td>
                <strong>{{ commande.status }}</strong>
              </td>
              <td>
                <router-link
                  :to="{ name: 'showCommandes', params: { id: commande.id, clientId: clientId } }"
                  class="btn btn-primary"
                >Voir</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'deleteCommandes', params: { id: commande.id, clientId: clientId } }"
                  class="btn btn-danger"
                >Supprimer</router-link>
              </td>
            </tr>
          </tbody>
        </table>
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
      commandes: [],
      clientId: 0,
      name: "mettre description"
    };
  },
  methods: {},
  mounted() {},
  created() {
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
      axios
        .get("/api/commandes/indexCommandesByClientId/" + this.clientId)
        .then(res => {
          this.commandes = res.data;
        });
    });
  },
  metaInfo() {
    return { title: this.$t("Commandes") };
  }
};
</script>
