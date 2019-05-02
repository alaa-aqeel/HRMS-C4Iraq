<template>
    <v-container >
        <v-timeline >
            <v-timeline-item v-for="(datatime,n) in datatimes" :key='n' >
                <span slot="opposite" class="headline font-weight-bold"
                > {{ datatime.title }} </span>
                <v-card class="elevation-2 hover">
                    <v-card-text class="font-weight-light" dir="rtl">
                        {{ datatime.text }}
                    </v-card-text>
                </v-card>
            </v-timeline-item>
        </v-timeline>
    </v-container>
</template>


<script>
export default{
    data(){
        return{
            datatimes:[
                    {
                    title:"التطوع ظاهرة مهمة",text:"التطوع ظاهرة مهمة للدلالة على حيوية الجماهير وإيجابيتها، لذلك يؤخذ مؤشراً للحكم على مدى تقدم الشعوب. إن العطاء بحرية عنصر رئيسي للمجتمع الصالح، لذا فإن الفرصة أمام الجميع للمشاركة لا يساعد فقط على تخطي عيوب بيروقراطية العمل الرسمي فحسب بل ويحقق متطلبات التنمية."
                },{
                    title:'تعليم الناشئين', text:'عندما نشرع في تعليم الناشئين أننا لا نعيش في مجتمع سلبي، مجتمع للمطالعة فقط مجتمع للنظريات فقط بل في مجتمع قابل للتعديل في مجتمع قابل للابتكار، حيث لدينا لقوة لتغيير مجتمعاتنا، لتغيير مؤسساتنا فحينها نبدأ حقًا بوضع أنفسنا على الطريق الصحيح نحو ابتكار تطبيقات مفتوحة نحو حركة المصادر المفتوحة نحو ثورة المجتمعات المفتوحة'
                },{
                    title:"المشاركة لبناء مجتمعاتهم",text:"على الجميع المشاركة لبناء مجتمعاتهم #خدمة_التكنولوجي_من_الشعب_والى_الشعب ما علينا سوى النظر في مجتمعاتنا لنرى الذكاء و الخبرة موزعين على نطاق واسع في المجتمع و ليسا مقتصرين ببساطة على مؤسساتنا. و الحاجة الملحة لدينا التي نشعر بها كلنا اليوم لإعادة تصميم في مؤسساتنا. نحن نعيش في عصر الحوسبة و البيانات الضخمة و الشبكات الإجتماعية و لدينا الفرصة لإعادة تصميم هذه المؤسسات"
                },{
                    title:"إتاحة الكثير من التطبيقات",text:'إتاحة الكثير من التطبيقات إتاحة و اجتذاب الكثير من فرص المشاركة. استخدام ملتقيات علمية مشاركة الافكار للعمل على البيانات لبناء التطبيقات أسلوب و مفهوم للناس لينخرطوا و يشاركوا مجتمعاتهم لكن إن أردنا أن نرى نوعية الابتكارات، و الأفكار الواعدة المثيرة إن أردنا أن نرى هذه الأفكار متبناة و أن نرى هذه الأفكار منتشرة فعلينا جميعاً أن نشارك علينا أن ننخرط. علينا أن نفتح مؤسساتنا ليتسنى الجميع في المشاركة من اجل بناء مجتمعاتهم وغد افضل'
                }
            ]
        }
    }

}


</script>


<style scop>
    .v-timeline::before{ display: block;  }
    @media (max-width: 767px)  {

        .v-timeline::before{ display: none;  }

        .v-timeline .v-timeline-item{ display: block; }
        .v-timeline-item__dot{ display: none; }
        .v-timeline .v-timeline-item .v-card::after, .v-timeline-item .v-card::before{ display: none;}
        .v-timeline  .v-timeline-item .v-timeline-item__body{ max-width:100%; }

        .v-timeline .v-timeline-item .v-timeline-item__opposite{
            max-width: 100%;
            padding: 10px;
            margin-top: -55px;
            transition:1s;
        }

        .v-timeline-item__body:hover + .v-timeline-item__opposite{ margin-top: 0px; }
    }
</style>