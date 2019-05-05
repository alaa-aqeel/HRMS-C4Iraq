import Vue from "vue";
import VueRouter from "vue-router";


Vue.use(VueRouter);

import Home from './views/home.vue';
import About from './views/about.vue';
import Project from './views/project.vue';
import Setting from './views/setting.vue';
import Profile from './views/profile.vue';
import Teams  from './views/teams.vue';
import Paths  from './views/paths.vue';
import Train  from './views/train.vue';


const router = new VueRouter({
    mode: 'history',
    routes:[
        { path:"/", name:"home", component:Home ,props: { default: true}},
        { path:"/about", name:"about", component:About ,props: { default: true} },

        { path:"/project", name:"project", component:Project ,props: { default: true} , meta:{login:true} },
        { path:"/setting", name:"setting", component:Setting ,props: { default: true} , meta:{login:true} },
        { path:"/profile", name:"profile", component:Profile ,props: { default: true} , meta:{login:true} },
        { path:"/train", name:"train", component:Train ,props: { default: true} , meta:{login:true} },


        { path:"/teamsmanger", name:"teams", component:Teams ,props: { default: true} , meta:{login:true,team_manger:true} },
        { path:"/pathmanger", name:"path", component:Paths ,props: { default: true} , meta:{login:true,path_manger:true} },


        { path: '*', redirect: '/' }, 
    ]
});

router.beforeEach((to,from,next)=>{
    const auth = JSON.parse(localStorage.getItem('Data-User'));

    if( to.meta.login  ){
        axios.get("api/member", {headers:{Authorization:`Bearer ${auth.token}`}} )
        .then((resp)=>{
            if(resp.data.user){               
                var data = resp.data.user
 
                if( to.meta.team_manger && data.active  ){
                    if( data.team_manger ) { next(); }
                    else{ next("/") } 
                }else if( to.meta.path_manger && data.active  ){
                    if( data.id_path_manger ) { next(); }
                    else{ next("/") } 
                }else if( data.active ){
                    if(data.active) {next();}
                    else{ next("/") }  
                }else{ next('/') }

            }else{ next() }

        }).catch(resp=>{ next("/") })
    }else{ next() }
    
})


export default router; 