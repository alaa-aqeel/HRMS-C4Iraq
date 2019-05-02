<template>

    <v-card style="height: 100%;">
        <v-card-title primary-title>
            <div>
                <div class="headline" > 
                    <a flat @click='$emit("open")'>
                        {{ title }} 
                    </a>
                </div>
            </div>
        </v-card-title>

        <v-slide-y-transition  style="height: 100%;">
            <v-card-text style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                {{ text }} 
            </v-card-text>
        </v-slide-y-transition>
        
        <br>
        <br>
        <v-card-actions>
                <v-btn flat color='primary' @click='$emit("update",id)'>update</v-btn>
                <v-btn flat color="error"   @click='$emit("delete",id)'>delete</v-btn>
                <v-spacer></v-spacer>
                <v-btn icon :href='url' target="_blank">
                    <v-icon>link</v-icon>
                </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default{
    props: ['title','text','url','id']
}
</script>