<template>
    <v-container>
        <br>     <br>    <br>        <br>
        <v-subheader v-if='data.path'> {{ data.path[0].path }} </v-subheader>
        <team-card :data='data' ></team-card>
    </v-container>
</template>


<script>
import Path from "./../components/mangers/path.vue";

export default {
    props:['user','token'],
    components:{
        'team-card':Path
    },
    data(){
        return{
            data : {}
        }
    },
    created(){
        this.fetchMember();
    },
    methods: {
        fetchMember(){
            axios.get("api/member/path", {headers:{Authorization:`Bearer ${this.token}`}} )
            .then(resp=>{
                if(resp.data.Success){
                    this.data = resp.data.Success
                    console.log(resp);
                }
               
            })
            
        }
    }
}
</script>