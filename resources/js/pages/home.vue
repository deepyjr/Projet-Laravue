<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <p>test button</p>
    <router-link :to="{ name: 'campus' }">{{ $t('campus') }}</router-link>
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
  mounted() {},
  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
