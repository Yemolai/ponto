/* global Vue */
Vue.component('v-sidebar', {
  template: '#template-v-sidebar',
  props: ['dark', 'open', 'toggleDarkTheme'],
  computed: {
    isOpen: {
      get: function () {
        return this.open || false;
      },
      set: function () {
        return false;
      }
    },
    logged: function () {
      return this.$store.state.pis !== null;
    }
  },
  methods: {
    _toggleDarkTheme: function () {
      if (this.toggleDarkTheme && typeof this.toggleDarkTheme === 'function') {
        this.toggleDarkTheme();
      }
    },
    instalar: function () {
      alert('Desculpe, não é possível instalar no momento.');
    },
    executar: function (item) {
      if ('path' in item) { // se tiver path navega pro caminho .path dado
        this.$router.push(item.path);
      } else if ('action' in item) { // se tiver action executa método .action
        item.action(this);
      }
    },
    registerPIS: function () {
      var pis = prompt('Informe PIS', '');
      if (!pis || pis.length < 11) {
        alert('Nenhum valor informado');
      } else {
        this.$store.state.pis = pis;
      }
    },
    removePIS: function () {
      if (confirm('Tem certeza que deseja remover o PIS salvo?')) {
        this.$store.state.pis = null;
        alert('PIS removido.');
      }
    }
  },
  data: function () {
    return {
      temaEscuro: this.dark,
      drawer: null,
      items: [
        { heading: 'Autenticação' },
        { icon: 'person', text: 'Se identificar por PIS', action: function (vm) { vm.registerPIS(); }, logged: false },
        { icon: 'person', text: 'Remover identificação ', action: function (vm) { vm.removePIS(); }, logged: true },
        { heading: 'Suas marcações', logged: true },
        { icon: 'face', text: 'Detalhes do funcionário', path: '/funcionario', logged: true },
        { icon: 'content_copy', text: 'Pontos duplicados', path: '/duplicates', logged: true },
        { icon: 'message', text: 'Justificativas', path: '/justificativas', logged: true },
        { icon: 'calendar_today', text: 'Meses anteriores', path: '/months', logged: true },
        { heading: 'Preferências e ajuda' },
        { icon: 'phonelink', text: 'Instalar neste dispositivo', action: function (vm) { vm.instalar(); } },
        { icon: 'settings', text: 'Configurações', path: '/config', logged: true },
        { icon: 'invert_colors', text: 'Alternar tema', action: function (vm) { vm._toggleDarkTheme(); } },
        { icon: 'chat_bubble', text: 'Dê sua opinião', path: '/opinar' },
        { icon: 'info', text: 'Ajuda sobre uso do app', path: '/ajuda' },
      ]
    };
  }
});
