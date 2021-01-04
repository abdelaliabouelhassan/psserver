const routes = [
    { path: '/', component:  require('../components/app/home').default },
    { path: '/home', component:  require('../components/app/home').default },
    { path: '/faq', component: require('../components/app/FAQ').default },
    { path: '/contact', component: require('../components/app/contact').default },
    { path: '/myprofile', component: require('../components/app/user').default },
    { path: '/serverdetails/:slug', component: require('../components/app/server_details').default },
    { path: '/createserver', component: require('../components/app/addserve').default },
    { path: '/edit/:slug', component: require('../components/app/edit').default },
    { path: '/notfound', component: require('../components/app/errors/404').default },
    { path: '*', component: require('../components/app/errors/404').default },
];

export default  routes


