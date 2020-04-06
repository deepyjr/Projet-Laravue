import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import CoreuiVue from '@coreui/vue'
import { iconsSet as icons } from '../assets/icons/icons'

import '~/plugins'
import '~/components'

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
