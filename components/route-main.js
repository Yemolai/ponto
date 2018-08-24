/* global Vue, moment */
Vue.component('route-main', {
  template: '#template-route-main',
  data: function () {
    return {
      year: (new Date()).getFullYear(),
      month: (new Date()).getMonth() + 1,
      message: null,
      loading: true,
      marcacoes: [],
    };
  },
  created: function () {
    this.loadMarcacoes(this.month, this.year);
  },
  computed: {
    pis: function () {
      return this.$store.state.pis;
    }
  },
  watch: {
    pis: function (newValue, oldValue) {
      // eslint-disable-next-line no-console
      console.log('triggered this.$user._pis watcher');
      if (newValue !== oldValue) {
        this.loadMarcacoes(this.month, this.year);
      }
    }
  },
  methods: {
    next: function () {
      if (this.month == 12) {
        this.year += 1;
        this.month = 1;
      } else {
        this.month += 1;
      }
      this.loadMarcacoes(this.month, this.year);
    },
    prev: function () {
      if (this.month == 1) {
        this.year -= 1;
        this.month = 12;
      } else {
        this.month -= 1;
      }
      this.loadMarcacoes(this.month, this.year);
    },
    loadMarcacoes: function (m, y) {
      this.loading = true;
      if (this.pis) {
        var url = './api/index.php/marcacoes/pis/' + this.pis + (y ? '/' + y : '') + (m ? '/' + m : '');
        var vm = this;
        this.$http.get(url).then(function (response) {
          if ('data' in response && !('error' in response.data)) {
            return Object.keys(response.data).map(function (data) {
              return {
                data: data,
                times: response.data[data].map(function (v) {
                  return moment(data + 'T' + v.datetime).format('LT');
                })
              };
            });
          }
          return [];
        })
          .catch(function (err) {
            // eslint-disable-next-line no-console
            console.error('Erro:', err);
            return [];
          })
          .then(function (marcacoes) {
            vm.loading = false;
            vm.marcacoes = marcacoes;
          });
      } else {
        this.message = 'Informe o seu PIS para poder carregar seus dados';
        this.loading = false;
        return [];
      }
    },
  }
});