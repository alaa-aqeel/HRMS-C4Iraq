<template>
    <v-container>
        <v-card style="margin-top: 7%;">
            <v-snackbar v-model="alert" top :timeout='6000' :color='alert_type' >
                {{ alert_text }}
                <v-btn flat icon @click="alert = false"> <v-icon>close</v-icon></v-btn>
            </v-snackbar>
            <v-card-title style="text-align: center"><span class="headline"> Setting </span></v-card-title>

            <v-card-text>
                <v-container >
                    <v-layout wrap>
                        <v-flex xs12>
                            <v-btn color="blue white--text" @click="upass=!upass;"> Change Password</v-btn>
                            
                        </v-flex>
                    </v-layout>
                    <v-divider></v-divider> 
                    <v-layout wrap>

                        <v-flex xs12 style="margin-bottom: 2%">
                            <password-setting @alertsnack='snack($event)' :upass='upass' :token='token'></password-setting>
                        </v-flex>

                    </v-layout>
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

            </v-card-actions>
        </v-card>
    </v-container>
</template>


<script>
import Password from "./../components/setting/password.vue";

export default{
    components:{
        "password-setting":Password
    },
    props:['user','token'],
    data(){
        return {
            alert :false, 
            alert_type : 'success',
            alert_text : '',
            upass: false ,
        }
    },
    methods:{
        snack(d){
            this.alert = true 
            this.alert_type = d.type
            this.alert_text = d.mesg
        },
    }

}

</script>