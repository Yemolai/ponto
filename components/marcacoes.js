/* global Vue, moment */
Vue.component('marcacoes', {
  template: '#template-marcacoes',
  computed: {
    pis: function () {
      var local = localStorage.getItem('pis');
      var session = sessionStorage.getItem('pis');
      return local || session || null;
    }
  },
  data: function () {
    return {
      carregando: true,
      marcacoes: [],
      rowsPerPage: [7, 14, 30, 31, { 'text': 'Tudo', 'value': -1 }],
      colunas: [
        { value: 'data', text: 'Data' },
        { value: 'in1', text: 'Entrada inicial', sortable: false },
        { value: 'out1', text: 'Saída almoço', sortable: false },
        { value: 'in2', text: 'Retorno almoço', sortable: false },
        { value: 'out2', text: 'Saída final', sortable: false },
        { value: 'extras', text: 'Pontos extras', sortable: false }
      ]
    };
  },
  methods: {
    getTableData: function () {
      if (this.pis) {
        var url = './api/index.php/marcacoes/pis/' + this.pis;
        var vm = this;
        this.$http.get(url)
          .then(function (response) {
            if ('data' in response && !('error' in response.data)) {
              return Object.keys(response.data)
                .map(function (data) {
                  return {
                    data: data,
                    times: response.data[data]
                      .map(function (v) {
                        return moment(data + 'T' + v.datetime)
                          .format('LT');
                      })
                  };
                });
            }
            return [];
          })
          .then(function (marcacoes) {
            vm.marcacoes = marcacoes;
          })
          .then(function () {
            vm.carregando = false;
          })
          .catch(function () {
            vm.marcacoes = [];
            alert('Não foi possível carregar as informações.');
          });
      } else {
        this.marcacoes = [];
        this.carregando = false;
        alert('Informe um PIS utilizando a barra lateral, por favor.');
      }
    }
  },
  mounted: function () {
    this.getTableData();
  }
});