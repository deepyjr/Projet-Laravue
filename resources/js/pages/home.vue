<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <br />
    <router-link class="btn btn-primary" :to="{ name: 'campus' }">{{ $t('campus') }}</router-link>
    <router-link
      class="btn btn-primary"
      :to="{ name: 'commandes' , params: { clientId: 3 } }"
    >{{ $t(' Mes commandes') }}</router-link>
    <!-- TODO changer le clientId-->
  </card>
</template>

<script>
export default {
  middleware: "auth",
  resource: null,
  data() {
    return {};
  },
  methods: {},
  mounted() {},
  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
