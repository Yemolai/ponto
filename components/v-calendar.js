/* global Vue, moment */
/* eslint-disable no-console */
// TODO: converter o uso do moment por Date padrão JS para exportação
Vue.component('v-calendar', {
  template: '#template-v-calendar',
  props: ['year', 'month', 'marcacoes', 'nextMonth', 'prevMonth'],
  data: function () {
    return {
      weekdays: [
        'Domingo',
        'Segunda-feira',
        'Terça-feira',
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado'
      ]
    };
  },
  methods: {
    next: function () {
      this.nextMonth && typeof this.nextMonth === 'function' ? this.nextMonth() : null;
    },
    prev: function () {
      this.prevMonth && typeof this.prevMonth === 'function' ? this.prevMonth() : null;
    },
    getMarcacoes: function (date) {
      var marcacoes = this.marcacoes;
      var d = moment(date).format('YYYY-MM-DD');
      return marcacoes && marcacoes instanceof Array
        ? marcacoes
          .filter(function (marcacao) {
            return marcacao.data === d;
          })
          .reduce(function (acc, marcacao) {
            return marcacao.times;
          }, [])
        : [];
    }
  },
  computed: {
    referenceDate: function () {
      var Y = Number(this.year || 0);
      var M = Number(this.month || 0);
      var y = isNaN(Y) || Y < 1970 || Y > 2100 ? (new Date()).getFullYear() : Y;
      var m = isNaN(M) || M < 1 || M > 12 ? (new Date()).getMonth() : M - 1;
      return moment().year(y).month(m).date(1);
    },
    calendarMonthTitle: function () {
      return this.referenceDate.format('MMMM [de] YYYY');
    },
    weeks: function () {
      var vm = this;
      var date = this.referenceDate;
      var mes = date.month();
      var weeks = (new Array(5))
        .fill(null)
        .map(function (v, idxWeek) {
          var sunday = moment(date).add(idxWeek, 'week').day(0);
          var saturday = moment(date).add(idxWeek, 'week').day(6);
          if (sunday.month() === mes || saturday.month() === mes) {
            return (new Array(7))
              .fill(1)
              .map(function (v, weekDay) {
                var dia = sunday.day(weekDay);
                return {
                  dia: dia.format('DD'),
                  marcacoes: vm.getMarcacoes(dia),
                  otherMonth: dia.month() !== mes
                };
              });
          } else {
            return false;
          }
        })
        .filter(function (v) { return v; }); // just to eliminate possible extra empty week
      return weeks;
    },
  },
});
