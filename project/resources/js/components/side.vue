<template>
    <v-navigation-drawer app stateless v-model="drawer" >

        <v-list class="pa-1" dense>
            <v-list-tile avatar>
                <v-list-tile-avatar >
                    <img src="/images/c4i.png">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title> Code For Iraq </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        
        <v-list class="pt-0" dense>
            <v-divider></v-divider> 

            <v-list-tile @click='$emit("close")' v-if='user.first_name' :to='user.active ? "/profile" : false'>
                <v-list-tile-action>
                    <v-icon>account_circle</v-icon>
                </v-list-tile-action>
                <v-list-tile-content >
                    <v-list-tile-title >
                        {{ `${user.first_name} ${user.last_name}`.toUpperCase() }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            

            
            <v-list-tile @click='$emit("close")' v-for="item in items" :key="item.title" :to='item.href' @click.stop=''>
                <v-list-tile-action >
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title> {{ item.title }} </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            

            <v-list-tile  @click='$emit("close")'
                v-if=' user.active && user.team_manger' 
                to="/teamsmanger"  >
                
                <v-list-tile-action>
                    <v-icon>fas fa-user-tie</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Manger Teams</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile> 

            <v-list-tile  @click='$emit("close")'
                v-if=' user.active && user.id_path_manger' 
                to="/pathmanger"  >
                <v-list-tile-action>
                    <v-icon>fas fa-user-tie</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Manger Path</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile> 

            
            <v-list-tile v-if='user.active' :to="item.href" @click='$emit("close")'
                v-for="item in active" :key="item.title" >
                
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile> 

        </v-list>

    </v-navigation-drawer>
</template>


<script>
export default{
    props:['drawer','user'],
    data(){
        return{
            items:[
                {title:"Home",icon:"home",href:"/"},
                {title:"About",icon:"question_answer",href:"/about"}
                
            ],

            active:[
                {title:'Projects',icon:'archive',href:'/project'},
                {title:'Train',icon:'school',href:'/train'},
                {title:'Setting',icon:'settings',href:'/setting'}, 
            ],

        }
    },
    
    mounted(){
        // var side = document.getElementsByClassName('sidedrawer')
        // side[0].onclick = (e)=>{ 
        //     this.$emit('close');
        //     console.log(e);
        // }
    }
}
</script>