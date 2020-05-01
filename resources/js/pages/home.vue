<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <br />
    <router-link class="btn btn-primary" :to="{ name: 'campus' }">{{ $t('campus') }}</router-link>
    <router-link class="btn btn-primary" :to="{ name: 'commandes'}">{{ $t(' Mes commandes') }}</router-link>
    <p>{{dashbord}}</p>
  </card>
</template>

<script>
export default {
  middleware: "auth",
  resource: null,
  data() {
    return {
      dashbord: [],
      clientId: 0
    };
  },
  methods: {},
  mounted() {
    axios.get("/api/user/getCurrentUserInformation").then(res => {
      this.clientId = res.data.user.id;
    });
  },
  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
