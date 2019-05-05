<template>
    <v-container>
        <br><br><br>
        <v-snackbar v-model="alert" top :timeout='6000' :color='alert_type' >
            {{ alert_text }}
            <v-btn flat icon @click="alert = false"> <v-icon>close</v-icon></v-btn>
        </v-snackbar>
        <v-card v-if='data.path'>
            <v-card-title class="indigo white--text headline">
                Path
            </v-card-title>
            <v-card-text>
                <v-container  >
                    <v-card style="padding: 10px;" class="text-xs-center">
                        <v-card-text >
                            <path-member 
                                @alertsnack='snack($event)' 
                                :token='token'
                                :pathdata='data.path[0]'>
                            </path-member>
                        </v-card-text>
                    </v-card>
                </v-container>
            </v-card-text>
        </v-card>
        <br/><br/>
        <tutorial-card v-if='data.tutorial' :tutorial='data.tutorial'></tutorial-card>
        
    </v-container>
</template>

<script>
import Path from "./../components/train/path.vue";
import Tutorial from "./../components/train/tutorial.vue";


export default{
    components:{
        "path-member" : Path,
        "tutorial-card" : Tutorial,
    },
    props:['user','token'],
    data(){
        return {
            alert :false, 
            alert_type : 'success',
            alert_text : '',
            edit: false,
            data: {}
        }
    },
    methods:{
        snack(d){
            this.alert = true 
            this.alert_type = d.type
            this.alert_text = d.mesg
            this.fetchMember()
        },
        fetchMember(){
            axios.get("api/member/userpath",{
                headers:{Authorization:`Bearer ${this.token}`}
            }).then(resp=>{
                if(resp.data.Success){
                    this.data = resp.data.Success
                }
            })
        }
    },
    created(){
       this.fetchMember()
    }

}
</script>