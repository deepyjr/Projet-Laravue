function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },
  { path: '/dashboard', name: 'dashboard', component: page('dashboard.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') },
  ////////////////////////////////////////////////////////////////////////////
  { path: '/campus', name: 'campus', component: page('campus/index.vue') },
  { path: '/campus/:id', name: 'showCampus', component: page('campus/showCampus.vue') },
  { path: '/campus/create', name: 'createCampus', component: page('campus/createCampus.vue') },
  { path: '/campus/:id/delete', name: 'deleteCampus', component: page('campus/deleteCampus.vue') },
  { path: '/campus/:id/edit', name: 'editCampus', component: page('campus/editCampus.vue') },
  ////////////////////////////////////////////////////////////////////////////
  { path: '/sites', name: 'sites', component: page('sites/index.vue') },
  { path: '/sites/:id', name: 'showSites', component: page('sites/showSite.vue') },
  { path: '/sites/create', name: 'createSites', component: page('sites/createSite.vue') },
  { path: '/sites/:id/delete', name: 'deleteSites', component: page('sites/deleteSite.vue') },
  { path: '/sites/:id/edit', name: 'editSites', component: page('sites/editSite.vue') },
  ////////////////////////////////////////////////////////////////////////////
  { path: '/objets', name: 'objets', component: page('objets/index.vue') },
  { path: '/objets/create', name: 'createObjets', component: page('objets/createObjet.vue') },
  { path: '/objets/:id/delete', name: 'deleteObjets', component: page('objets/deleteObjet.vue') },
  { path: '/objets/:id/edit', name: 'editObjets', component: page('objets/editObjet.vue') },
  { path: '/objets/:id/progammerLavage', name: 'progLavageObjets', component: page('objets/progLavageObjet.vue') },
  ////////////////////////////////////////////////////////////////////////////
  { path: '/commandes', name: 'commandes', component: page('commandes/index.vue') },
  { path: '/commandes/:id/delete', name: 'deleteCommandes', component: page('commandes/deleteCommande.vue') },
  { path: '/commandes/:id', name: 'showCommandes', component: page('commandes/showCommande.vue') },
]

