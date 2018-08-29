/* global Vue */
Vue.component('v-topbar', {
  template: '#template-v-topbar',
  methods: {
    toggleSidebar: function() {
      this.$store.state.drawerOpen = !this.$store.state.drawerOpen;
    }
  }
});