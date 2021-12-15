import VueRouter from 'vue-router';
import Components from './components';
import AuthService from './service/AuthService';

const router = new VueRouter({
    routes:[
        {
            path: '/', component: Components.Login
        },
        {
            path: '/admin', component: Components.AdminLayout,
            children:[
                {
                    path:'', redirect:'practice-profile'
                },
                {
                    path:'practice-profile', component: Components.PracticeProfile
                },
                {
                    path:'member', component: Components.TeamMember
                }
            ],
            meta: {
                authenticated: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authenticated)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!AuthService.IS_LOGGED_IN()) {
        next({
            path: '/',
            query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else {
        next() // make sure to always call next()!
    }
})

export default router;
