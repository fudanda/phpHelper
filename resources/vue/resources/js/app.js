// ie polyfill
import '@babel/polyfill'

import Vue from 'vue'
//import App from './App.vue'
import router from './router/'
import store from './store/'
import {
    VueAxios
} from './utils/request'

// mock
import './mock'

import bootstrap from './core/bootstrap'
import './core/use'
import './permission' // permission control
import './utils/filter' // global filter



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


Vue.config.productionTip = false

// mount axios Vue.$http and this.$http
Vue.use(VueAxios)

new Vue({
    router,
    store,
    apolloProvider,
    created() {
        bootstrap()
    }
    // ,
    // render: h => h(App)
}).$mount('#app')
