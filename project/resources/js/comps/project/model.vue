<template>
    <v-dialog v-model="fab" fullscreen hide-overlay transition="dialog-bottom-transition" >
        {{ fab ?  setData : null }}
        
        <v-toolbar dark color="primary">
            <v-btn icon dark @click="$emit('close')">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title>{{ navtitle }} Project</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn v-if='navtitle == "Add"' dark flat @click="add">{{ navtitle }}</v-btn>
                <v-btn v-else dark flat @click="update"> {{ navtitle }} </v-btn>                    
            </v-toolbar-items>
        </v-toolbar>

        <v-container grid-list-md>
            <v-form ref="projaddfrom" lazy-validation>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field v-model='nameproject' label="Project Name*" type="text" required :rules='valid'></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                        <v-menu full-width offset-y min-width="290px">
                            <v-text-field readonly v-model="startat" :rules='valid'
                                prepend-icon="event" 
                                slot="activator" 
                                label="Start At" required
                            ></v-text-field>
                            <v-date-picker v-model="startat" no-title scrollable></v-date-picker>
                        </v-menu>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                        <v-menu full-width offset-y min-width="290px">
                            <v-text-field readonly v-model="endat" :rules='valid'
                                prepend-icon="event" 
                                slot="activator" 
                                label="End At" required
                            ></v-text-field>
                            <v-date-picker v-model="endat" no-title scrollable></v-date-picker>
                        </v-menu>
                    </v-flex>
                    
                    <v-flex xs12>
                        <v-text-field v-model='url' label="Github Url*" required :rules='valid'></v-text-field>
                    </v-flex>
                    
                    <v-flex xs12>
                        <v-combobox chips solo multiple clearable
                            :items='itemtag'
                            v-model="tags" 
                            label="Tags Project like : laravel, vuejs, mysql "  
                        ><template slot="selection" slot-scope="data">
                                <v-chip :selected="data.selected" @input="remove(data.item)" >
                                    <strong>{{ data.item }}</strong>&nbsp;
                                </v-chip>
                            </template>
                        </v-combobox>
                    
                    </v-flex>

                    <v-flex xs12>
                        <v-textarea required :rules='valid'
                            v-model='about'
                            label="About Project*"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
            </v-form>
        </v-container>
    </v-dialog>
</template>

<script>
export default{
    props:[ "fab", 'navtitle' ,"data"],
    data(){
        return {
            itemtag:[
                "python","laravel","php",'ionic',"destkop application",
                "anguler","vue","react","bootstrap","postgre","moblie application",
                "java","kotline","flask","django","mysql","firebase","web site","web application"
            ],
            nameproject : "",
            startat:"",
            endat:"",
            about:"",
            url:"",
            tags:"",
            valid:[
                v => !!v || 'field is required',
            ]
        }
    },
    computed:{
        setData : function (){
            if (this.data[0]){
                this.nameproject = this.data[0].project_name
                this.startat     = this.data[0].start_at
                this.endat       = this.data[0].end_at
                this.about       = this.data[0].about_project
                this.url         = this.data[0].github_url
            }
            return 
        }
    },
    methods:{
        remove (item) {
            this.tags.splice(this.chips.indexOf(item), 1)
            this.tags = [...this.chips]
        },
        update(){
            if( this.$refs.projaddfrom.validate() ){
                this.$emit('update',{
                    project_name:this.nameproject,
                    start_at:this.startat,
                    end_at:this.endat,
                    about_project:this.about,
                    github_url:this.url,
                });this.$refs.projaddfrom.reset();
            }
        },
        add(){
            if( this.$refs.projaddfrom.validate() ){
                this.$emit('add',{
                    project_name:this.nameproject,
                    start_at:this.startat,
                    end_at:this.endat,
                    about_project:this.about,
                    github_url:this.url,
                    tags:this.tags.join(","),
                });this.$refs.projaddfrom.reset();
            } 
        }
    }
}
</script>