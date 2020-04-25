import Vue from 'vue';
import Router from 'vue-router';
import Load from 'src/components/Load/Load';


Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [{
    path: '/',
    name: 'Загрузить фото',
    component: Load
  }]
});
