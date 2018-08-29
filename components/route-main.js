/* global Vue */
Vue.component('route-main', {
  template: '#template-route-main',
  methods: {
    go: function (route) {
      this.$router.push(route);
    }
  },
  computed: {
    logged: function () {
      return this.$store.state.pis !== null;
    }
  },
  data: function () {
    return {
      //
    };
  }
});
