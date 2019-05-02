<template>
    <v-toolbar app extended tabs fixed>

        <v-toolbar-side-icon @click.stop="$emit('togleSide')" v-show='!side'></v-toolbar-side-icon>
        <v-btn icon v-show='side'  @click.stop="$emit('togleSide')">
            <v-icon>arrow_back</v-icon>
        </v-btn>

        <v-spacer></v-spacer>
        <v-menu top left transition="slide-x-reverse-transition">
                <v-btn icon slot="activator">
                    <v-icon>more_vert</v-icon>
                </v-btn>

                <v-list>
                    <div v-if='user.username'>
                        <v-list-tile @click='$emit("logout")'>
                            <v-list-tile-title > Log-Out </v-list-tile-title> 
                        </v-list-tile>
                    </div>
                    <div v-else>
                        <v-list-tile href='#'>
                            <dialog-login @login='$emit("login",$event)'></dialog-login>
                        </v-list-tile>
                        <v-list-tile href='#'>
                            <dialog-register @login='$emit("login",$event)'></dialog-register>
                        </v-list-tile>
                    </div>
                </v-list>
        </v-menu>

    </v-toolbar>
</template>


<script>
import Login from "./../components/login.vue";
import Register from "./../components/register.vue";
export default{
    components:{
            'dialog-login':Login,
            'dialog-register':Register
    },
    props:['side','user'],
    data(){
        return{
            // Islogin:false,
        }
    },
}
</script>

<style >
    .theme--dark.v-toolbar,.theme--light.v-toolbar{background: none}
    .v-toolbar{box-shadow: none;}
</style>
    