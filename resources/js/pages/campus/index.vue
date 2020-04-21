<template>
  <div class="card" :title="$t('IndexCampus')">
    <div class="card-content">
      <div class="content">
        <table class="table is-hoverable">
          <thead>
            <tr>
              <th>#</th>
              <th>Campus</th>
              <th></th>
              <th></th>
              <th></th>
              <th>
                <router-link
                  :to="{ name: 'createCampus'}"
                  class="btn btn-primary"
                >Créer un nouveau campus</router-link>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(camp, index) in campus" v-bind:key="index">
              <td>{{ camp.id }}</td>
              <td>
                <strong>{{ camp.name }}</strong>
              </td>
              <td>
                <router-link
                  :to="{ name: 'showCampus', params: { id: camp.id } }"
                  class="btn btn-primary"
                >Voir</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'editCampus', params: { id: camp.id } }"
                  class="btn btn-warning"
                >Modifier</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'deleteCampus', params: { id: camp.id } }"
                  class="btn btn-danger"
                >Supprimer</router-link>
              </td>
              <td>
                <router-link
                  :to="{ name: 'sites', params: { id: camp.id } }"
                  class="btn btn-primary"
                >Voir les sites</router-link>
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
      campus: [],
      userId: "1" //TODO Changer le userId
    };
  },
  methods: {},
  mounted() {
    axios.get("/api/campus/indexByClientId/" + this.userId).then(res => {
      this.campus = res.data;
    });
  },
  metaInfo() {
    return { title: this.$t("Campus") };
  }
};
</script>
