<template>
    <v-card v-if='tutorial.length'>
        <v-card-title class="indigo white--text headline">
            Tutorial
            <v-spacer></v-spacer>
            <v-chip v-if='tutorial' color="primary" text-color="white">
                {{ tutorial.length }}
            </v-chip>
        </v-card-title>
        <v-container fluid grid-list-md>
            <v-layout row warp>
                <v-flex v-if='tutorial.length' lg3 md4 sm6 xs12 
                        v-for='tut,i in tutorial' :key='i'>

                    <v-card xs12 style="height: 100%;" >
                        <v-card-title primary-title>
                            {{ tut.name }}  
                            <v-flex xs12>
                                <small> {{ tut.tacher_name }}  </small>
                            </v-flex>
                        </v-card-title>
                        <v-slide-y-transition  style="height: 100%;" text-xs-center >
                            <v-card-actions style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                <v-btn icon dark  color="blue" flat  target="_blank"  :href='tut.url'>
                                    <v-icon dark>link</v-icon>
                                </v-btn>
                                <v-spacer></v-spacer>
                                <v-chip >
                                    {{ tut.count_video }}
                                </v-chip> 
                            </v-card-actions>
                        </v-slide-y-transition>
                    </v-card> 
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
export default{
    props:['tutorial'],

}

</script>