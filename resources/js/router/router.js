const routes = [
    { path: '/', component:  require('../components/app/home').default },
    { path: '/home', component:  require('../components/app/home').default },
    { path: '/register', component:  require('../components/ExampleComponent').default },
    { path: '/login', component:  require('../components/login').default },

];

export default  routes


