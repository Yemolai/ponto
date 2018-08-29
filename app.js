/* global Vue, VueRouter, Vuex, axios, moment */
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.$http = axios;
Vue.prototype.$storage = window.localStorage;

// configure libs
moment.locale('pt-br');

// build the store
var store = new Vuex.Store({
  state: {
    pis: null,
    drawerOpen: false,
    darkTheme: false
  },
  mutations: {
    initialiseStore: function (state) {
      if (localStorage.getItem('store')) {
        var rawSavedState = localStorage.getItem('store');
        if (rawSavedState === null) {
          // nothing to load from localStorage, abort
          return false;
        }
        var savedState = JSON.parse(rawSavedState);
        var newState = Object.assign(state, savedState);
        this.replaceState(newState);
      }
    },
    PIS: function (state, newValue) {
      state.pis = newValue;
    },
    DRAWER: function (state, newValue) {
      state.drawerOpen = (newValue === true);
    },
    DARK: function (state, newValue) {
      state.darkTheme = (newValue === true);
    }
  }
});

// Store the state object as a JSON string
store.subscribe(function (mutation, state) {
  localStorage.setItem('store', JSON.stringify(state));
});

// define routes:
var routes = [
  { path: '/', component: Vue.component('route-main') },
  { path: '/calendar', component: Vue.component('route-calendar') }
];

// instance VueRouter with routes
var router = new VueRouter({ routes: routes });

// compose Vue instance
// eslint-disable-next-line no-unused-vars
var App = new Vue({
  name: 'Ponto',
  router: router,
  store: store,
  beforeCreate: function () {
    this.$store.commit('initialiseStore');
  },
  methods: {
    toggleTheme: function () {
      this.darkTheme = !this.darkTheme;
      this.$storage.setItem('theme', this.darkTheme ? 'dark' : 'light');
    },
    toggleSidebar: function () {
      this.sidebarOpen = !this.sidebarOpen;
      this.$storage.setItem('drawer', this.sidebarOpen ? 'open' : 'closed');
    }
  },
  mounted: function () {
    this.darkTheme = this.$storage.getItem('theme') === 'dark';
    this.sidebarOpen = this.$storage.getItem('drawer') === 'open';
  },
  data: function () {
    return {
      darkTheme: false,
      sidebarOpen: {
        _open: false,
        get: function () {
          return this._open;
        },
        set: function (newValue) {
          this._open = newValue;
          return this;
        }
      },
    };
  }
}).$mount('#app');