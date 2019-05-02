<template>
    <div>
        <v-card>
            <!-- {{ data }} -->
            <v-card-title class="indigo white--text headline">
                Members 
                <v-spacer></v-spacer>
                <v-chip v-if='data.path' color="primary" text-color="white">
                    {{ data.teams.length }}
                </v-chip>
            </v-card-title>
            <v-container fluid grid-list-md>
                <v-layout row warp>
                    <v-flex v-if='data.teams.length' lg3 md4 sm6 xs12 text-xs-center
                        v-for='member,i in data.teams' :key='i'
                     >
                        <v-card xs12 style="height: 100%;" >
                            <v-card-title primary-title>
                                <v-flex xs12>
                                    <v-avatar :size='100'>
                                        <img :src='"/images/profile/"+member.image_profile'> 
                                    </v-avatar>
                                </v-flex>
                                <v-flex xs12>
                                    <div class="headline" > 
                                        {{ `${member.first_name} ${member.last_name}` }}
                                    </div>
                                </v-flex>
                            </v-card-title>
                        
                            <v-slide-y-transition  style="height: 100%;" text-xs-center >
                                <v-card-actions style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                    <v-btn icon dark  color="blue" flat  target="_blank"  :href='"https://fb.com/"+member.id_facebook'>
                                        <v-icon dark>fab fa-facebook-f</v-icon>
                                    </v-btn>
                                    <v-btn icon dark  color="blue" flat  target="_blank"  :href='"https://t.me/"+member.id_telegram'>
                                        <v-icon dark>fab fa-telegram</v-icon>
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <menu-drop v-if='member' :member='member'></menu-drop>
                                </v-card-actions>
                            </v-slide-y-transition>
                        </v-card> 
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
        <br>
        <br>
        <!-- {{ data }} -->
        <tutorial-card v-if='data.tutorials' :tutorial='data.tutorials'></tutorial-card>
    </div>
</template>

<script>
import Menu from "./menu.vue";
import Tutorial from "./../train/tutorial.vue";
export default{
    components:{
        'menu-drop':Menu,
        'tutorial-card':Tutorial
    },
    props:['data','title'],
}
</script>



