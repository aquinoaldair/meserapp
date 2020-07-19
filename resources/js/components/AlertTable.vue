<template>
    <li class="onhover-dropdown">
       <template>
           <img style="max-width: 40px" src="/icons/notificacion_nueva.png" alt="">
           <span v-if="total" style="color:white" class="dot"/>
           <ul class="notification-dropdown onhover-show-div">
               <li>Mensajes <span class="badge badge-pill badge-primary pull-right">{{ total }}</span></li>
               <li v-for="item in notifications">
                   <div class="media">
                       <div class="media-body">
                           <h6 class="mt-0"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag shopping-color"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                           </span>MESA {{ item.name }}<small class="pull-right"></small></h6>
                           <p class="mb-0">Tienes nuevos pedidos en esta mesa</p>
                       </div>
                   </div>
               </li>
           </ul>
       </template>
        <template>
            <audio id="myAudio">
                <source src="/sounds/ordered.mp3" type="audio/mpeg">
            </audio>
        </template>
    </li>
</template>

<script>
    import {Howl, Howler} from 'howler';

    export default {
        name: "AlertTable",
        props: ['admin'],
        data(){
            return{
                notifications : [],
                counter : 0,
                sound : ""
            }
        },
        mounted() {
            if (this.admin == 0){
                setInterval(this.getTabled, 10000);
            }
        },
        computed: {
            total(){
                return this.notifications.length;
            }
        },
        methods:{
            getTabled(){
                var vm = this;
                axios.get('/service/table/status/ordered')
                    .then(function (response) {
                        vm.notifications = response.data;
                        if (vm.notifications.length > 0){
                            vm.counter = 0;
                            vm.playSound();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            async playSound(){
                var vm = this;
                this.counter++;
                if (this.counter <= 3 ){
                    var sound = new Howl({
                        src: '/sounds/ordered.mp3'
                    });
                    console.log("reproduciendo sonido");
                    sound.play();
                    await this.sleep(2000);
                    this.playSound();
                }else{
                    this.counter = 0;
                }
            },
            sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }
        }
    }
</script>

<style scoped>

</style>
