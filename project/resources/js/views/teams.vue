<template>
    <v-container>
        <br>
        <br>
        
        <v-subheader v-if='user.governorate'> 
            <strong>
                {{user.governorate.toUpperCase()}}
            </strong> 
        </v-subheader>

        <team-card :data='teams'></team-card>
    </v-container>
</template>


<script>
import Teams from "./../components/mangers/teams.vue";

export default {
    props:['user','token'],
    components:{
        'team-card':Teams
    },
    data(){
        return{
            teams : {}
        }
    },
    created(){
        this.fetchMember();
    },
    methods: {
        fetchMember(){
            axios.get("api/member/team", {headers:{Authorization:`Bearer ${this.token}`}} )
            .then(resp=>{
                if(resp.data.Success){
                    this.teams = resp.data.Success.teams
                }
            })
            
        }
    }
}
</script>