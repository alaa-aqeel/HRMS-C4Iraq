<template>
    <div>
        <div v-if='edit'>
            <v-autocomplete 
                v-model="selectval"
                :items="items"
                :loading="isLoading"
                :search-input.sync="search"
                hide-no-data
                hide-selected
                label="Paths"
                placeholder="Select Path"
                return-object
            ></v-autocomplete>
            <v-text-field v-model='videocomplate' type='number' label="Video Complate" ></v-text-field>
            <v-btn color="blue white--text" flat @click="select"> Set </v-btn>
            <v-btn color="blue white--text" flat @click="edit = !edit"> 
                Cansel 
            </v-btn>
        </div>
    
        <div v-else  >
            <v-layout align-center justify-center >
                <v-breadcrumbs v-if='pathdata.path' :items='pathdata.path.split("->")' divider="->">
                    <template v-slot:item="props">
                        <a> {{ `${props.item.trim()} ` }} </a>
                    </template>
                </v-breadcrumbs>
                <h4>{{ `lessen : ${pathdata.complatet}` }}</h4>
            </v-layout>
            <v-btn v-if='!edit' color="blue white--text" flat @click="edit = !edit"> 
                Update 
            </v-btn>
        </div>

    </div>
</template>
    
<script>
export default{
    props:['token','pathdata'],
    data(){
        return {
            videocomplate:this.pathdata.complatet,
            selectval:null,
            isLoading:false,
            items:[],
            indexit:[],
            search: null,


            edit: false,
        }
    },
    watch:{
        search(val){
            if (val.length > 1) return
            if (this.isLoading) return
            this.isLoading = true
            
            axios.get("api/member/paths/",{
                headers:{Authorization:`Bearer ${this.token}`}
            })
            .then((resp)=>{
                resp.data.Success.forEach((i)=>{
                    this.items.push(i.path);
                    this.indexit[i.id] = i.path
                })
                this.isLoading = false
            }).catch((resp)=>{ console.log(resp) })
            
        }
    },
    methods:{
        select(){
            axios.post("api/member/userpath/",
                {   
                    id:this.indexit.indexOf(this.selectval),
                    complatet:this.videocomplate
                },
                {headers:{Authorization:`Bearer ${this.token}`}}
            ).then((resp)=>{
                this.$emit('alertsnack',{
                    type:'success',
                    mesg:"Success Select Paht "
                })
                this.edit = false;
            })
        }
    }
}
</script>