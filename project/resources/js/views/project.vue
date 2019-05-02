<template>
    <v-layout>
        <v-container>
            
            <v-snackbar v-model="alert" top :timeout='6000' :color='alert_type' >
                {{ alert_text }}
                <v-btn flat icon @click="alert = false"> <v-icon>close</v-icon></v-btn>
            </v-snackbar>

            <v-card >
                <v-card-title class="indigo white--text headline">
                    Projects 
                    <v-spacer></v-spacer>
                    <v-chip v-if='datas' color="primary" text-color="white">
                        {{ datas.length }}
                    </v-chip>
                </v-card-title>
                <v-container fluid grid-list-md>
                    <v-layout row wrap>

                        <blockquote style="text-align: center" v-if='datas == "load"' class="blockquote">
                            loading . . . 
                        </blockquote>
                          
                        <blockquote v-else-if='datas == null' class="blockquote">
                            You not have any Projects to view !! 
                        </blockquote>
                       
                        <v-flex v-else lg4 md6 xs12 v-for='data in datas' :key='data.id'>
                            <cards-proj :id='data.id' 
                                :title='data.project_name' 
                                :text='data.about_project' 
                                :url='data.github_url'
                                @update='modelupdate($event)'
                                @open='projview(data.id)'
                                @delete='confirm = $event'
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
        <confirm-dialog text='delete this Project ' :confirm='!!confirm' @okay='del(confirm)' @close='confirm = false'></confirm-dialog>

        <model-proj  :fab='fab' :navtitle='btnnav' :data='project' style="margin-top: 20px"
            @add='add($event)'
            @update='update($event)'
            @close='fab = false'
        ></model-proj>
        
        <view-proj :data="project" :fab="fabview" @close='fabview = false'></view-proj>
    </v-layout>
</template>

<script>
import Card from "./../components/projects/card.vue";
import Model from "./../components/projects/model.vue";
import Info from "./../components/projects/info.vue";

export default{
    components:{
        "cards-proj" : Card,
        "model-proj" : Model,
        "view-proj"  : Info
    },
    props: ['user','token'],
    data(){
        return {
            project: {},
            datas : null,
            fab: false,
            fabview : false ,
            id : "",
            btnnav : '',
            confirm: 0,
            alert : false, 
            alert_type : 'success',
            alert_text : '',
        }
    },
    mounted(){
        this.projects(); 
    },
    methods:{
        projects(){
            this.datas = 'load'
            axios.get("api/member/project/",{
                headers:{Authorization:`Bearer ${this.token}`}
            }).then((resp)=>{
                if(resp.data.Errors){ this.datas = null; }
                else{ this.datas = resp.data.Success.data }   
            })
            // .catch((resp)=>{ this. })
        },
        add(data){
            axios.post("api/member/project/",data,
                {headers:{Authorization:`Bearer ${this.token}`}}
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
                {headers:{Authorization:`Bearer ${this.token}`}}
            ).then((resp)=>{ 
                this.project = resp.data.Success
                this.fabview    = true 
            })
        },
        del(id){ 
            this.confirm = false;
            axios.delete(`api/member/project/${id}`,
                {headers:{Authorization:`Bearer ${this.token}`}}
            ).then((resp)=>{ 
                this.alert = true 
                this.alert_type = "success" 
                this.alert_text = `Success delete Project ` 
            });this.projects();
            },
        modelupdate(id){
            this.id  = id ;
            axios.get(`api/member/project/${id}`,
                {headers:{Authorization:`Bearer ${this.token}`}}
            ).then((resp)=>{ 
                this.project = resp.data.Success
                this.btnnav = "Update" ;
                this.fab    = true 
            })
        },
        update(data){
            axios.put(`api/member/project/${this.id}`,data,
                {headers:{Authorization:`Bearer ${this.token}`}})
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

