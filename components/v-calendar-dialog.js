/* global Vue */
Vue.component('v-calendar-dialog', {
  template: '#template-v-calendar-dialog',
  computed: {
    show: {
      get: function () {
        return this.$store.state.showCalendarDialog || false;
      },
      set: function (newValue) {
        return this.$store.commit('SHOW_CALENDAR_DIALOG', newValue);
      }
    },
    data: function () {
      return this.$store.state.calendarDialogData || {
        date: '',
        marcacoes: []
      };
    }
  }
});
