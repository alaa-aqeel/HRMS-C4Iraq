<template>
    <div>
        <v-container style="margin-top: 5%" >
            <h1 v-if='loading'> Loading . . . </h1>
            <div v-else >
                <div v-if='!update'>
                    <info-profile v-if='profile' :data='data' @update='update = true'></info-profile>
                    <modal-profile v-else 
                        url='api/member/profile'
                        title='Create Profile' 
                        :token='token' 
                        @submit='ref()'
                        :data="{}"
                    ></modal-profile>
                </div>
                <div v-else>

                    <modal-profile 
                        url='api/member/profile/update'
                        title='Update Profile' 
                        :token='token' 
                        :data='data'
                        @submit='ref()'
                        @back='update = false'
                    ></modal-profile>
                </div>
            </div>
            
            
        </v-container>
    </div>
</template>


<script>
import Info from "./../components/profile/info.vue";
import Modal from "./../components/profile/create.vue";

export default{
    components:{
        'info-profile':Info,
        'modal-profile':Modal
    },
    props:['token','user'],
    data(){
        return {
            profile: false,
            data:{},
            loading: false,
            update: false
        }
    },
    mounted(){ this.ref(); },

    methods:{
        ref(){
            this.loading = true
            axios.get("api/member/profile",{
                headers:{Authorization:`Bearer ${this.token}`}
            }).then(resp=>{
                if(resp.data.Success){
                    this.profile = true;
                    this.data = resp.data.Success
                    this.update = false;
                }else{ this.profile = false }
                this.loading = false
               
            })
            
        }
    }
}
</script>