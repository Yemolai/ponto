/* global Vue, moment */
Vue.component('v-calendar-day', {
  template: '#template-v-calendar-day',
  props: ['day'],
  data: function () {
    return {
      tfmt: 'HH:mm',
      details: false
    };
  },
  methods: {
    showDetails: function () {
      var unorderedTimes = this.day ? 'marcacoes' in this.day ? this.day.marcacoes : [] : [];
      var times = unorderedTimes.slice(0).sort();
      var data = {
        date: this.day.dia || '',
        marcacoes: times
      };
      this.$store.commit('CALENDAR_DIALOG_DATA', data);
      this.$store.commit('SHOW_CALENDAR_DIALOG', true);
    }
  },
  computed: {
    weekend: function () {
      return this.day.weekday === 0 || this.day.weekday === 6 ? 'v-calendar-day-weekend' : '';
    },
    marcacoes: function () {
      var unorderedTimes = this.day ? 'marcacoes' in this.day ? this.day.marcacoes : [] : [];
      var times = unorderedTimes.slice(0).sort();
      var morningDiff = times.length >= 2
        ? moment(times[1], this.tfmt)
          .diff(moment(times[0], this.tfmt))
        : 0;
      var eveningDiff = times.length >= 4
        ? moment(times[3], this.tfmt)
          .diff(moment(times[2], this.tfmt))
        : 0;
      var total = Math.floor(moment.duration(morningDiff + eveningDiff).as('minutes'));
      var timeHours = Math.floor(total / 60).toString().padStart(2, '0');
      var timeMinutes = Math.floor(total % 60).toString().padStart(2, '0');
      return {
        length: times.length,
        morningIn: times[0] || '',
        morningOut: times[1] || '',
        eveningIn: times[2] || '',
        eveningOut: times[3] || '',
        extras: times.slice(4).join(', '),
        morningTime: morningDiff ? moment(morningDiff).format('LT') : '',
        eveningTime: eveningDiff ? moment(eveningDiff).format('LT') : '',
        time: timeHours + ':' + timeMinutes
      };
    }
  }
});