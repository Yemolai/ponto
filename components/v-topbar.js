/* global Vue */
Vue.component('v-topbar', {
  template: '#template-v-topbar',
  props: ['dark', 'toggleSidebar'],
  methods: {
    _toggleSidebar: function() {
      if (this.toggleSidebar && typeof this.toggleSidebar === 'function') {
        this.toggleSidebar();
      }
    }
  }
});