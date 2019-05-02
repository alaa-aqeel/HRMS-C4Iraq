<template>
    <v-layout>
        <v-container>
            <v-snackbar v-model="alert" top :timeout='6000' :color='alert_type' >
                {{ alert_text }}
                <v-btn flat icon @click="alert = false"> <v-icon>close</v-icon></v-btn>
            </v-snackbar>
            <v-card style="margin-top: 8%;">
                <v-container fluid grid-list-md>
                    <v-layout row wrap>
                        <blockquote v-if='datas == null' class="blockquote">
                            You not have any Projects to view !! 
                        </blockquote>
                       
                        <v-flex v-else lg4 md6 xs12 v-for='data in datas' :key='data.id'>
                            <cards-proj :id='data.id' 
                                :title='data.project_name' 
                                :text='data.about_project' 
                                :url='data.github_url'
                                @update='modelupdate($event)'
                                @open='projview(data.id)'
                                @delete='del($event)'
                            ></cards-proj>
                        </v-flex>
                    </v-layout>
                </v-container>

                <v-speed-dial v-model="fab" bottom right fixed>
                    <v-btn dark fab
                        v-model="fab" 
                        slot="activator"
                        color="blue darken-2"
                        @click='btnnav = "Add"'
                    > <v-icon>add</v-icon> <v-icon>close</v-icon> </v-btn>
                </v-speed-dial>

            </v-card>
        </v-container>
        <model-proj  :fab='fab' :navtitle='btnnav' :data='project' style="margin-top: 20px"
            @add='add($event)'
            @update='update($event)'
            @close='fab = false'
        ></model-proj>

        <view-proj :data="project" :fab="fabview" @close='fabview = false'></view-proj>

    </v-layout>

</template>

<script>
import cards from "./cards.vue";
import model from "./model.vue";
import view from "./view.vue";


export default{
    components:{
        "cards-proj" : cards,
        "model-proj" : model,
        "view-proj"  : view
    },
    props: ['user'],
    data(){
        return {
            project: {},
            datas : null,
            fab: false,
            fabview : false ,
            id : "",
            btnnav : '',

            alert : false, 
            alert_type : 'success',
            alert_text : '',
        }
    },
    created(){
        this.projects();
    },
    methods:{
        projects(){
            axios.get("api/member/project/",{
                headers:{Authorization:`Bearer ${this.user.tkn}`}
            }).then((resp)=>{
                if(resp.data.Errors){ this.datas = null; }
                else{ this.datas = resp.data.Success.data }   
            })
            
        },
        add(data){
            axios.post("api/member/project/",data,
                {headers:{Authorization:`Bearer ${this.user.tkn}`}}
            ).then((resp)=>{
                this.fab = false ;
                this.projects();

                this.alert = true 
                this.alert_type = "success" 
                this.alert_text = `Success Add Project ${data.project_name}` 
            })
        },
        projview(id){
            axios.get(`api/member/project/${id}`,
                {headers:{Authorization:`Bearer ${this.user.tkn}`}}
            ).then((resp)=>{ 
                this.project = resp.data.Success
                this.fabview    = true 
            })
        },
        del(id){ 
            axios.delete(`api/member/project/${id}`,
                {headers:{Authorization:`Bearer ${this.user.tkn}`}}
            ).then((resp)=>{ 
                this.alert = true 
                this.alert_type = "success" 
                this.alert_text = `Success delete Project ${id}` 
            });this.projects();
         },
        modelupdate(id){
            this.id  = id ;
            axios.get(`api/member/project/${id}`,
                {headers:{Authorization:`Bearer ${this.user.tkn}`}}
            ).then((resp)=>{ 
                this.project = resp.data.Success
                this.btnnav = "Update" ;
                this.fab    = true 
            })
        },
        update(data){
            axios.put(`api/member/project/${this.id}`,data,
                {headers:{Authorization:`Bearer ${this.user.tkn}`}})
            .then((resp)=>{
                this.projects();
                this.fab = false ;
                this.project = {};

                this.alert = true 
                this.alert_type = "success" 
                this.alert_text = `Success update Project ${data.project_name}` 
            })
        },
    }
}
</script>

<style>
.v-dialog--fullscreen{
    background-color: #fff;
    margin-top: 4%;
}

</style>