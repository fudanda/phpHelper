// window._ = require('lodash');

// try {
//     window.$ = window.jQuery = require('jquery');

//     // require('foundation-sites');
// } catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Vue from 'vue';
import router from '@/router/index'
import store from '@/store/index'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import Viser from 'viser-vue'
import api from '@/api/index'

/**graphql */
import {
    ApolloClient
} from 'apollo-client'
import {
    HttpLink
} from 'apollo-link-http'
import {
    InMemoryCache
} from 'apollo-cache-inmemory'
import VueApollo from 'vue-apollo'

const httpLink = new HttpLink({
    // GraphQL 服务器 URL，需要使用绝对路径
    uri: 'http://www.l.com/graphql'
})

// 创建 apollo client
const apolloClient = new ApolloClient({
    link: httpLink,
    cache: new InMemoryCache()
})
const apolloProvider = new VueApollo({
    defaultClient: apolloClient
})
// 安装 vue plugin
Vue.use(VueApollo)
/**graphql */

Vue.prototype.$axios = axios
Vue.config.productionTip = false
Vue.prototype.$api = api
Vue.use(Antd)
Vue.use(Viser)

new Vue({
    router,
    store,
    apolloProvider,
}).$mount('#app')
