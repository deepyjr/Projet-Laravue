<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <img class="logo-nav-bar" src="logo.png" alt="">
      <!-- <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
      {{ $t('Clean-It')}}
      </router-link> -->

      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul> -->

        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <div v-if="user" class="mt-2">
            <router-link class="mr-3 mt-4 navbar-item" :to="{ name: 'campus' }">{{ $t('Campus') }}</router-link>
            <router-link :to="{ name: 'dashboard' }" class="mr-3 mt-4 navbar-item" active-class="active">
              {{ $t('Dashboard') }}
            </router-link>

            <router-link
              class="mr-3 mt-4 pt-3 navbar-item"
              :to="{ name: 'commandes' , params: { clientId: 3 } }"
            >{{ $t('Mes commandes') }}</router-link>

          </div>
            
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>

            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
             
          </li>

          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
            <div >
              <CIcon name="cilBell" class="cloche_notif nav-item dropdown"/>
            </div>
            </a>

            <div class="dropdown-menu item-drop" >
                <p class="notif pl-2 pr-2 container-notif" v-for="(elem,key) in notif" :key="key">{{elem.description}} à {{elem.created_at}} pour le {{elem.date}} {{key}}
                  <a href="#" @click="checkId(key)">
                    <CIcon name="cilCheck" class="check_notif"/> 
                  </a>
                </p>
                
                
            </div>

          </li>

          

       
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
           
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    <!-- </div> -->
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import { library, icon } from '@fortawesome/fontawesome-svg-core'
import { faCamera } from '@fortawesome/free-solid-svg-icons'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    notif : [],
    notifPresence: 0,
    clientId: 1
  }),

  computed: mapGetters({
    user: 'auth/user',
    
  }),
  created(){
    this.checkNotif()
  },


  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    
    checkId(key){
      // console.log(key);
      // console.log(this.notif[key].id);
      this.deleteNotif(this.notif[key].id);
      this.checkNotif();
      // console.log(this.notif)
    },

    checkNotif () {
      axios.get("/api/notifications/indexNotificationByClientId/" + this.clientId).then(res => {

        this.notif = res.data;
      console.log('test',this.notif)
      });
    },

    deleteNotif (idNotif) {
      axios.post("/api/notifications/userSawNotifications/" + idNotif)
      .then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
.navbar-item{
  text-decoration: none; 
}
.logo-nav-bar{
  height: 70px;
}
.cloche_notif{
  height: 20px;
}
.item-drop{
  min-width: 350px;
}
.container-notif{
  display: flex;
}
.check_notif{
  height: 20px !important;
  margin-right: 10px;
}
</style>
