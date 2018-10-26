/* global Vue */
Vue.component('v-sidebar', {
  template: '#template-v-sidebar',
  computed: {
    isOpen: {
      get: function () {
        return this.$store.state.drawerOpen;
      },
      set: function (newValue) {
        this.$store.commit('DRAWER', newValue);
      }
    },
    logged: function () {
      return this.$store.state.pis !== null;
    }
  },
  methods: {
    showItem: function (item) {
      return 'logged' in item ? item.logged === true ? this.logged : !this.logged : true;
    },
    toggleDarkTheme: function () {
      this.$store.commit('DARK', !this.$store.state.darkTheme);
    },
    instalar: function () {
      alert('Desculpe, não é possível instalar no momento.');
    },
    executar: function (item) {
      if (!this.$vuetify.breakpoint.lgAndUp) {
        this.$store.commit('DRAWER', false);
      }
      if ('path' in item) { // se tiver path navega pro caminho .path dado
        this.$router.push(item.path);
      } else if ('action' in item) { // se tiver action executa método .action
        item.action(this);
      }
    },
    registerPIS: function () {
      var pis = prompt('Informe PIS', '');
      if (!pis) {
        alert('Campo vazio');
      } else if (pis.length < 11) {
        alert('PIS inválido');
      } else {
        this.$store.commit('PIS', pis);
      }
    },
    removePIS: function () {
      if (confirm('Tem certeza que deseja remover o PIS salvo?')) {
        this.$store.commit('PIS', null);
        alert('PIS removido.');
      }
    }
  },
  data: function () {
    return {
      items: [
        { icon: 'person', text: 'Se identificar por PIS', action: function (vm) { vm.registerPIS(); }, logged: false },
        { icon: 'person', text: 'Remover identificação ', action: function (vm) { vm.removePIS(); }, logged: true },
        { heading: 'Suas marcações', logged: true },
        { icon: 'calendar_today', text: 'Calendário', path: '/calendar', logged: true },
        // { icon: 'face', text: 'Detalhes do funcionário', path: '/funcionario', logged: true },
        // { icon: 'content_copy', text: 'Pontos com problemas', path: '/problematicos', logged: true },
        // { icon: 'message', text: 'Justificativas', path: '/justificativas', logged: true },
        { heading: 'Preferências e ajuda' },
        // { icon: 'phonelink', text: 'Instalar neste dispositivo', action: function (vm) { vm.instalar(); } },
        // { icon: 'settings', text: 'Configurações', path: '/config', logged: true },
        { icon: 'invert_colors', text: 'Alternar tema', action: function (vm) { vm.toggleDarkTheme(); } },
        { icon: 'chat_bubble', text: 'Dê sua opinião', path: '/opinar' },
        { icon: 'info', text: 'Ajuda sobre uso do app', path: '/ajuda' },
      ]
    };
  }
});
