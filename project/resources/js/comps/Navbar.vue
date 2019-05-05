<template>
    <div>
        <!-- 
            <v-progress-linear v-show='loading' :indeterminate="loading" style="margin:0;z-index:initial"></v-progress-linear>

            <v-snackbar v-model="snackbar" bottom left :timeout='6000' :color='snackbar_color'>
                {{ snackbar_text }}
                <v-btn color="pink" flat @click="snackbar = false">
                        Close
                </v-btn>
            </v-snackbar>
         -->
        <v-toolbar app extended tabs fixed>
            
            <v-toolbar-side-icon @click.stop="togle_side" v-show='!drawer_side'></v-toolbar-side-icon>
            <v-btn icon v-show='drawer_side'  @click.stop="togle_side">
                <v-icon>arrow_back</v-icon>
            </v-btn>
            
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>search</v-icon>
            </v-btn>
            <v-menu top left transition="slide-x-reverse-transition">
                <v-btn icon slot="activator">
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <div v-if='Islogin'>
                        <v-list-tile @click='logout'>
                                <v-list-tile-title> Log-Out </v-list-tile-title> 
                        </v-list-tile>
                    </div>
                    <div v-else>
                        <v-list-tile href='#'>
                            <login-comp @login='success_login'></login-comp>
                        </v-list-tile>
                        <v-list-tile href='#'>
                            <register-comp @login='success_login'></register-comp>
                        </v-list-tile>
                    </div>
                </v-list>
            </v-menu>

            <!-- <v-tabs  v-show='!Islogin'  slot="extension"  v-model="currentItem"  color="transparent"  fixed-tabs slider-color="yellow">
                <v-tab  href="#tab-home" >Home</v-tab>
                <v-tab  href="#tab-about">About</v-tab>
                <v-tab  :href="'#'+currentItem"></v-tab>
            </v-tabs> -->

        </v-toolbar> 

        <!-- 
        <side-comp :drawer='drawer_side' @select='taps_op($event)' :user='data_side_user' ></side-comp>

        <tabs-item-comp :currentItem='currentItem' :user='user'></tabs-item-comp> 
        -->

    </div>
</template>


<script>
export default{
    data(){
        return{
            currentItem:"tab-home",
            snackbar : false,
            snackbar_text : "",
            snackbar_color: "success",
            drawer_side:false,
            loading: false,
            Islogin: false,
            user : sessionStorage.getItem('Login-User') ? JSON.parse(sessionStorage.getItem('Login-User')): {},
            data_side_user : {}
        }
    },
    methods:{ 
        togle_side(){ 
            this.drawer_side = !this.drawer_side 
        },
        taps_op(tapnam){
            this.currentItem = tapnam;
        },
        success_login(data){
            if (data.token){
                sessionStorage.setItem('Login-User',JSON.stringify({tkn:data.token,email:data.email}));
                this.user = {tkn:data.token,email:data.email};
            }
            this.Islogin = true
            this.isActive();
        },
        logout(){
            this.data_side_user = {};
            this.Islogin = false
            sessionStorage.removeItem('Login-User');
            this.currentItem = "tab-home"
        },
        d_snackbar(msg){
            this.snackbar_text = msg;
            this.snackbar = true ;
        },
        isActive(){
            axios.get("api/member", {headers:{Authorization:`Bearer ${this.user.tkn}`}} )
            .then((resp)=>{
                if( resp.data.Errors == "not_active" ){
                    this.is_active = false ;
                    this.snackbar_text = "this Acounnt not active ";
                    this.snackbar_color = 'error';
                    this.snackbar = true;
                }else{ this.data_side_user = resp.data;}
            }).catch(resp=>{this.logout();})
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

        if (this.user.tkn){ this.success_login(this.user) };
    }
}
</script>

<style scop>
    .theme--dark.v-toolbar,.theme--light.v-toolbar{background: none}
    .v-toolbar{box-shadow: none;}
</style>
