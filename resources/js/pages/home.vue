<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <p>Voici les infos du client envoyées par le backend</p>
    <div>{{ users}}</div>
    <p>Formulaire pour modifier votre nom(name dans la dbb)</p>
    <form @submit.prevent="submitName">
      <input type="text" v-model="newName" />
      <button type="submit">Envoyer</button>
    </form>
  </card>
</template>

<script>
export default {
  middleware: "auth",
  resource: null,
  data() {
    return {
      users: [],
      newName: ""
    };
  },
  methods: {
    submitName() {
      console.log("posted");
      axios.post("/api/client", {
        content: this.newName
      });
    }
  },
  mounted() {
    axios.get("/api/client").then(res => {
      this.users = res.data;
    });
  },
  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
