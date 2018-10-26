/* global Vue */
Vue.component('v-calendar-week', {
  template: '#template-v-calendar-week',
  props: ['week'],
  computed: {
    desktop: function () {
      return this.$vuetify.breakpoint.mdAndUp;
    },
    mobile: function () {
      return this.$vuetify.breakpoint.smAndDown;
    },
    thisWeek: function () {
      return this.week.map(function (day, weekday) {
        return Object.assign(day, { weekday: weekday });
      });
    }
  }
});