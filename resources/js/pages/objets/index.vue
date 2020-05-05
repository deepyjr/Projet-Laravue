<template>
  <div class="card" :title="$t('IndexObjets')">
    <div class="card-content">
      <div class="content">
        <table class="table is-hoverable">
          <thead>
            <tr>
              <th>#</th>
              <th>Objets/dernier lavage</th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>
                <router-link
                  :to="{ name: 'createObjets', params: { siteId: siteId }}"
                  class="btn btn-primary"
                >Créer un nouvel objet</router-link>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(objet, index) in objets" v-bind:key="index">
              <td>{{ objet.id }}</td>
              <td>
                <strong>{{ objet.name }}/{{ objet.dernier_lavage }}</strong>
              </td>
              <td>
                <router-link
                  :to="{ name: 'editObjets', params: { id: objet.id, siteId: siteId } }"
                  class="btn btn-warning"
                >Modifier</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'deleteObjets', params: { id: objet.id, siteId: siteId } }"
                  class="btn btn-danger"
                >Supprimer</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'objets', params: { id: objet.id, siteId: siteId } }"
                  class="btn btn-primary"
                >Voir le robot assiocié</router-link>
              </td>
              <td v-if="objet.commande > 0">
                <button class="btn btn-info">Lavage en cours</button>
              </td>
              <td v-else>
                <button class="btn btn-primary" @click="laverObjet(objet)">Laver l'objet</button>
              </td>
              <td>
                <router-link
                  :to="{ name: 'progLavageObjets', params: { id: objet.id, siteId: siteId } }"
                  class="btn btn-primary"
                >Programmer un lavage</router-link>
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
      objets: [],
      userId: 0,
      siteId: 0
    };
  },
  methods: {
    getTheCurrentDate() {
      var currentdate = new Date();
      var datetime =
        currentdate.getFullYear() +
        "-" +
        (currentdate.getMonth() + 1) +
        "-" +
        currentdate.getDate() +
        " " +
        currentdate.getHours() +
        ":" +
        currentdate.getMinutes() +
        ":" +
        currentdate.getSeconds();
      return datetime;
    },
    laverObjet(objet) {
      axios
        .post("/api/commandes", {
          clientId: this.clientId,
          objetId: objet.id,
          date_debut: this.getTheCurrentDate(),
          status: "Debut"
        })
        .then(res => {
          objet.commande = 1;
        });
    }
  },
  mounted() {
    axios.get("/api/objets/indexBySiteId/" + this.siteId).then(res => {
      this.objets = res.data;
    });
  },
  created() {
    this.siteId = this.$route.params.id;
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.userId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("Objets") };
  }
};
</script>
