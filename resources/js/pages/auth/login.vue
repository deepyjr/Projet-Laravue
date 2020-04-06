<template>
  <div class="row">
    
    <div class="col-lg-8 m-auto">
      <div class="log">
        <div> 
          <img src="logo.png" alt="logo" class="logo">
        </div>
        <div>
         <form @submit.prevent="login" @keydown="form.onKeydown($event)">
           <h2 class="mb-3">Log In</h2>
            <!-- Email -->
            <div class="form-group row">
              <label class="textform col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
              <div class="col-md-7">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control inp" type="email" name="email">
                <has-error :form="form" field="email" />
              </div>
            </div>

            <!-- Password -->
            <div class="form-group row">
              <label class="textform col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
              <div class="col-md-7">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control inp" type="password" name="password">
                <has-error :form="form" field="password" />
              </div>
            </div>

            

            <div class="form-group row">
              <div class="col-md-7 offset-md-3 d-flex">
                <!-- Submit Button -->
                <v-button :loading="form.busy" class="but">
                  {{ $t('login') }}
                </v-button>
                
                <!-- GitHub Login Button -->
                <login-with-github />
              </div>
            </div>
            <!-- Remember Me -->
            <div class="form-group row textform">
              <div class="col-md-3" />
              <div class="col-md-7 d-flex">
                <checkbox v-model="remember" name="remember">
                  {{ $t('remember_me') }}
                </checkbox>
                <div class="ml-3 forgot">
                  <router-link :to="{ name: 'password.request' }" class="ml-3 small ml-auto my-auto">
                    {{ $t('forgot_password') }}
                  </router-link>
                </div>
               
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins&display=swap');

  body{
    width: 100%;  
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    background: rgb(89,190,233);
    background: -moz-linear-gradient(45deg, rgba(89,190,233,1) 0%, rgba(0,97,201,1) 100%);
    background: -webkit-linear-gradient(45deg, rgba(89,190,233,1) 0%, rgba(0,97,201,1) 100%);
    background: linear-gradient(45deg, rgba(89,190,233,1) 0%, rgba(0,97,201,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#59bee9",endColorstr="#0061c9",GradientType=1);
  }
  .log{
  
  position: relative;
  left:-110px;
  width: 960px;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;
  padding: 177px 130px 177px 95px;
  }
  .logo{
  max-width: 350px;

  }
  h2{
    text-align: center;
    font-family: 'Montserrat', sans-serif;
  }
  .textform{
    font-family: 'Poppins', sans-serif;
  }
  .inp{
    border-radius: 10px;
    width: 100%;
    color: rgb(89,190,233);
  }
  .but{
    background-color: #007bff!important;
    width: 100%;
    border-radius: 10px;
  }
</style>