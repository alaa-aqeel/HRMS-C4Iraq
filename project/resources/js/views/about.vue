<template>
    <div style="background-color: #fff">
        <!-- <v-img class="ab-imag" src='/images/4f.png' ></v-img> -->

        <div class="content">
            <v-img dark src="/images/4f.png" class="img-banner" ></v-img>
            <h1 class="text-title text-lg-center"> Code For Iraq </h1>
            <p  class="text-content " dir="rtl">
                <span style="font-size:4rem;">
                    من الشعب وإلى الشعب
                </span>
                <br>
                <br>
                <span style="font-size:1.5rem;">
                    فكرة التكنولوجية من الشعب وإلى الشعب يجب أن نعمل جميعا على تحقيقها لاننا نحن بحاجة لمواطنين صناع 
                </span> 
            </p>

            <v-layout align-center column style="text-align: center;">
                <blockquote id='text-block' class="blockquote display-5 font-weight-medium" dir="rtl">
                    وهي مبادرة إنسانية غير ربحية تهدف الى خدمة المجتمع عن طريق البرمجة Programming. تعتبر "Code For IRAQ" مبادرة تعليمية حقيقية ترعى المهتمين بتعلم تصميم وبرمجة تطبيقات الهاتف الجوال ومواقع الانترنت وبرامج الحاسوب والشبكات والاتصالات ونظم تشغيل الحاسوب باستخدام التقنيات مفتوحة المصدر Open Source ، كما توفر لهم جميع الدروس التعليمية اللازمة وبشكل مجاني تماماً ، حيث يتسنى لطالب العلم أن يكتسب الخبرة العملية أثناء وبعد فترة الدراسة وذلك ليسهل عليه ايجاد الوظيفة وبشكل سريع بعد التخرّج وتهدف هذه المبادرة الى تحويل المجتمع من مجتمع سلبي مستهلك الى مجتمع ايجابي منتج يعتمد بالدرجة الاساس على استثمار العقول والخبرات والمهارات بغض النظر عن العمر او التخصص بل الاهم من ذلك تعتمد على مبدأ المواطنة والمشاركة الفاعلة في تأسيس وبناء المجتمع تدعو هذه المبادرة جميع الطلبة والخريجين والهواة والأساتذة الجامعيين والمهتمين مجال البرمجة وتقنيات المعلومات وكذلك الاختصاصات الاخرى الى التطوع والمشاركة الفعلية لأجل الارتقاء بواقع البلد ، حيث تعتبر فرصة عظيمة لاكتساب الخبرة والمهارة عن طريق تصميم وتنفيذ برامج وتطبيقات خدمية من شأنها خدمة المواطن وذلك ضمن مجاميع عمل نشطة وفعّالة يتعاون فيها جميع الأفراد كفريق واحد يتبادل الاراء والخبرات ويطرح الافكار لتتم مناقشتها وتطبيقها على أرض الواقع ، كما تفتح المجال لجميع المواطنين العراقيين ومن جميع الاختصاصات إلى المشاركة الفاعلة في هذه المشاريع لرفد الفريق بالخبرات والافكار والاراء والمقترحات التي من شأنها خدمة المجتمع بأفضل ما يمكن. لا يخفى على أحد أن لمثل هذه المبادرات دور رئيسي في تحسين ورفع اقتصاد البلد ، حيث يتم فيها إبراز المقدرة الحقيقية والذكاء الحقيقي للمواطن العراقي مما يساعد على استقطاب الخبرات المحلية وتوظيفها بدلاً عن استيراد الخبرات الاجنبية والتي عادة ما تكون مكلفة جداً للشركات والمؤسسات الحكومية والأهلية وجميع القطاعات العاملة في البلد والتي قد لا تظاهي أحيانا خبرة وكفاءة وإخلاص المواطن العراقي ، كما إن سيطرة الشركات والعمالات الأجنبية على سوق العمل العراقي ساهم في تقليص فرص التوظيف بشكل هائل نتج عنه عدد كبير من الافراد العاطلين عن العمل من ذوي الخبرات والشهادات والاختصاصات المختلفة ، وهنا يأتي دور الجامعات والمؤسسات والشركات العراقية في التثقيف والتطوير والمشاركة في تغيير وتحسين القوة الاقتصادية والعلمية للبلد ورفع مكانته بين البلدان الاخرى. 
                </blockquote>
            </v-layout>
            <v-img class="ab-imag" src='/images/pn.svg' style="margin-left: -1px;" ></v-img>
            <time-line style="background-color: #fff"></time-line>
        </div>

        
    </div>
</template>


<script>
    import TimeLine from "./../components/timeline.vue";
    export default{
        components:{
            'time-line':TimeLine
        }
    }
</script>

<style >
    #title-block{
        width: 100%;
        background: #87b8d9;
        color: #fff;
        padding: 1%;
        font-size: 46px;
    }

    #text-block{
        padding: 15px 5rem;
        background-color: #fff;
        color: #333;
        box-shadow: 0 0 6px #ffffff1a;
    }

    .ab-imag{
        height: 764px;
    }

    .ab-imag .v-image__image{
        background-size: 66%;   
    }
    /*  */
    .v-parallax__content{padding: auto;}
    .img-banner{height: 764px;}
    
    #block-text{
        text-align: center;
        background-color: #33333342;
        color: #fff;
        box-shadow: 0 0 6px #ffffff4d;
    }
    
    .content .v-image__image{
        width: 50%;
        height: 100%;
        background-repeat:no-repeat;
        background-size:contain;
        background-position:center;
    }

    .text-content{
        position: absolute;
        top: 25%;
        left: 65%;
        transform: translate(-50%, -50%);
        color: #444;
        font-size: 1.3rem;
        width: 60%;
        line-height: 150%;
        transition: 1s;
        text-shadow: 
            1px 0px 1px #ccc, 0px 1px 1px #eee, 
            2px 1px 1px #ccc, 1px 2px 1px #eee,
            3px 2px 1px #ccc, 2px 3px 1px #eee,
            4px 3px 1px #ccc, 3px 4px 1px #eee,
            5px 4px 1px #ccc, 4px 5px 1px #eee,
            6px 5px 1px #ccc, 5px 6px 1px #eee,
            7px 6px 1px #ccc;
    }

    .text-title{
        position: absolute;
        top: 5%;
        left: 45%;
        transform: translate(-50%, -50%);
        font-size: 4rem;
        color:#333;
        transition: 1s;
        text-shadow: 0 1px 0 #ccc,
                0 2px 0 #c9c9c9,
                0 3px 0 #bbb,
                0 4px 0 #b9b9b9,
                0 5px 0 #aaa,
                0 6px 1px rgba(0,0,0,.1),
                0 0 5px rgba(0,0,0,.1),
                0 1px 3px rgba(0,0,0,.3),
                0 3px 5px rgba(0,0,0,.2),
                0 5px 10px rgba(0,0,0,.25),
                0 10px 10px rgba(0,0,0,.2),
                0 20px 20px rgba(0,0,0,.15);
    }

    @media (max-width: 767px)  {
        .img-banner{ height: 450px; }
        .text-title{font-size: 3rem;top: 0%;left: 20%;transform:unset;}
        .content .v-image__image{ width: 100%;}
        .text-content{ font-size: 1.1rem;position:unset;left: auto;transform: translate(0%, -40%);width: 100%;padding: 0 10px;}

        .ab-imag{ height: 564px; }
        #text-block{ padding: 15px 1rem;font-size: 1.2rem }
        .ab-imag .v-image__image{ background-size: 100%;   }
    }
</style>