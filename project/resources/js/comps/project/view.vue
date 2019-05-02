<template>
    <v-dialog v-if='data[0]' v-model="fab" fullscreen hide-overlay transition="dialog-bottom-transition" >

        <v-toolbar dark color="primary">
            <v-btn icon dark @click="$emit('close')">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title> {{ data[0].project_name }} </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn flat :href='data[0].github_url' target="_blank">
                    github<v-icon>link</v-icon>
                </v-btn>             
            </v-toolbar-items>
        </v-toolbar>

        <v-container grid-list-md>
            <v-card>
                <v-slide-y-transition >
                    <v-card-text >
                        <blockquote class="blockquote" style="white-space: pre;"
                        >{{ data[0].about_project.trim() }}</blockquote>
                    </v-card-text>
                </v-slide-y-transition>
            </v-card>
            <br>
            <v-card>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex xs12 sm6 md6>
                            <v-text-field readonly :value='data[0].start_at' 
                                prepend-icon="event" 
                                label="Sart At" required
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md6>
                        <v-text-field readonly  :value='data[0].end_at' 
                                prepend-icon="event" 
                                label="End At" required
                            ></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <br>
            <v-card>
                <v-container grid-list-md>
                    <v-chip v-for='tag,i in data[0].tags.split(",")' :key='i' color="secondary" text-color="white">{{ tag }}</v-chip>
                </v-container>
            </v-card>
        </v-container>
    </v-dialog>
</template>

<script>
export default{
    props: ['data','fab']
}
</script>