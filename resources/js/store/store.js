import Vue from 'vue'
import Vuex from 'vuex'
import createMultiTabState from 'vuex-multi-tab-state';
Vue.use(Vuex)



export default new Vuex.Store({
    state:{
        islogin:false,
        user:[],
    },
    getters:{

    },
    mutations:{

    },
    actions:{

    },
     plugins: [
         createMultiTabState({
             statesPaths: ['user','islogin'],
         }),
    ],

});
