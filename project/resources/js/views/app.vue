<template>
    <v-app>
        <v-progress-linear v-show='loading' :indeterminate="loading" style="margin:0" ></v-progress-linear>

        <nav-bar :side='drawerside' :user='user' 
                @togleSide='drawerside = !drawerside' 
                @login='login($event)' @logout='logout'></nav-bar>

        <side-bar :drawer='drawerside' :user='user' @close='drawerside = !drawerside'></side-bar> 

        <router-view :user='user' :token='dataLogin.token'></router-view>

        <v-snackbar v-model="snackbar" bottom left :timeout='6000' color='error'>
            this Acounnt not active 
            <v-btn color="pink" flat @click="snackbar = false">
                    Close
            </v-btn>
        </v-snackbar>
    </v-app> 
</template>

<style scop>
    .theme--light.application{background: #fff;}
    html{overflow-y: auto;}
</style>


<script>
import Side from "./../components/side.vue";
import Navbar from "./../components/navbar.vue";

export default{
    components:{
        'side-bar':Side,
        'nav-bar':Navbar,
    },
    data(){
        return{
            snackbar: false,
            loading: false,
            drawerside:false,
            user:{},
            dataLogin: localStorage.getItem('Data-User') ? JSON.parse(localStorage.getItem('Data-User')): {},
        }
    },
    // computed:{},
    methods:{
        login(data){
            if (data.token){
                localStorage.setItem('Data-User',JSON.stringify({token:data.token,email:data.email}));
                this.dataLogin = {token:data.token,email:data.email};
            }
            this.isActive();
        },
        isActive(){
            axios.get("api/member", {headers:{Authorization:`Bearer ${this.dataLogin.token}`}} )
            .then((resp)=>{
                if( resp.data.Errors == "not_active" ){
                    this.snackbar = true;
                } 
                this.user = resp.data.user;
            }).catch(resp=>{this.logout();})

        },
        logout(){ 
            this.user = {};
            this.dataLogin = {};
            localStorage.removeItem('Data-User');
            this.$router.push("/");
         }
    },
    created() {
        axios.interceptors.request.use((config) => {
            this.loading = true
            return config;
        }, (error) => {
            this.loading=false
            return Promise.reject(error);
        });

        axios.interceptors.response.use((response) => {
            this.loading=false
            return response;
        }, (error) => {
            this.loading=false
            return Promise.reject(error);
        });

        if (this.dataLogin.token){ this.login(this.dataLogin) };
    }
}
</script>

<style>
.popup-visible {
    position: absolute;
    z-index: 10;
    visibility: visible;
}

.popup-hidden {
    position: absolute;
    z-index: 10;
    visibility: hidden;
}

</style>