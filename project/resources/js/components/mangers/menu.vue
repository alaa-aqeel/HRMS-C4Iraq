<template>
    <div class="text-xs-center" v-if='member'>
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :nudge-width="200"
            offset-x
        >

            <template v-slot:activator="{ on }">
                <v-btn icon dark  color="black" flat v-on="on">
                    <v-icon dark>more_vert</v-icon>
                </v-btn>
            </template>
            <v-card>
                <v-list>
                    
                    <v-list-tile v-if='!member.path'>
                        <v-list-tile-title  style="font-weight: bold;width: auto;">Governorate :</v-list-tile-title>
                        <v-list-tile-action>
                            {{ member.governorate }} 
                        </v-list-tile-action>
                    </v-list-tile>

                    <v-list-tile v-if='member.path'>
                        <v-list-tile-title style="font-weight: bold;width: auto;">Path :</v-list-tile-title>
                        <v-list-tile-action>
                            {{ member.path }} 
                        </v-list-tile-action>
                    </v-list-tile>

                    <v-list-tile >
                        <v-list-tile-title style="font-weight: bold;width: auto;">Video Complate :</v-list-tile-title>
                        <v-list-tile-action>
                            {{ member.complatet }} 
                        </v-list-tile-action>
                    </v-list-tile>
                    
                </v-list>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="menu = false">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-menu>
    </div>
</template>


<script>
    export default {
        props:["member"],
        data: () => ({
            fav: true,
            menu: false,
            message: false,
            hints: true
        })
    }
</script>