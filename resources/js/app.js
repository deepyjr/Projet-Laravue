import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import CoreuiVue from '@coreui/vue'
import { iconsSet as icons } from '../assets/icons/icons'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import '~/plugins'
import '~/components'

window.Vue = require('vue');
library.add(faUserSecret)
var VueResource = require('vue-resource');
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(VueResource);
window.axios = require('axios');
//Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

Vue.config.productionTip = false
Vue.use(CoreuiVue)
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  icons,
  router,
  ...App
})
