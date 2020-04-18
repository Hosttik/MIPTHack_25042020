import Vue from "vue";
import App from "src/components/App/App";
import router from "src/router/router";
import store from "src/store/store";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import colors from "vuetify/es5/util/colors";
import Notifications from 'vue-notification';
const SocialSharing = require('vue-social-sharing');


Vue.use(Vuetify,{
  icons: {
    iconfont: 'fa',
  },
  theme: {
    primary: colors[store.state.theme].lighten1,
    secondary: colors[store.state.theme].darken1,
    accent: colors[store.state.theme].accent1
  }
});
Vue.use(SocialSharing);
Vue.use(Notifications);

new Vue({
  el: "#app",
  router,
  store,
  template: "<App/>",
  components: { App }
});
