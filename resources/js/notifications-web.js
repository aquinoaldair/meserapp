import { EventBus } from './event-bus.js'

import axios from 'axios';

var intervalSound = null;

$( document ).ready(function() {
    initSocket();
});

function initSocket() {
    const isAdmin = $("#check-admin").attr("data-is-admin");

    if (isAdmin == 1 || isAdmin == "1") return;

    //este es la url del socket a conectarse
    const server_socket = $("#check-admin").attr("data-socket-server");

    //este es la ruta actual del proyecto
    const current_route = $("#check-admin").attr("data-current-route");

    //este es nuestro dominio actual donde esta esta app
    const socket_client_url = $("#check-admin").attr("data-socket-client");

    //obtenemos el commerce_id
    const commerce_id = $("#check-admin").attr("data-commerce-id");

    getNewOrderOrPaymentsInTable(commerce_id, current_route);

    //conectamos el socket
    const socket = io.connect(server_socket, { 'forceNew': true });


    //estamos a la escucha de notificaciones
    socket.on('notification', function (data) {
        //si el dominio de donde se envio la notificación es igual al dominio actual del proyecto entonces ejecutamos la notificación
        if(data.domain == socket_client_url && data.commerce_id  == commerce_id){
            displayNotification(data, current_route);
        }
    });
}

function getNewOrderOrPaymentsInTable(commerce_id, current_route){
    // Make a request for a user with a given ID
    axios.get('/service/table/status/ordered')
        .then(function (response) {
            // handle success
            response.data.forEach(function (table) {
                var title = "";
                if (table.status == "ordered") title = "Nueva orden en la mesa "+table.name;
                if (table.status == "paying") title = "Solicito la cuenta mesa "+table.name;

                const data = {
                    'table_id' : table.id,
                    'table_name' : table.name,
                    'room_id' : table.room_id,
                    'table_status' : table.status,
                    'title' : title,
                    'commerce_id' : commerce_id,
                    'text' : "MESA "+table.name
                };

                displayNotification(data, current_route);
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}

function displayNotification(data, current_route) {

    if (intervalSound == null){
        intervalSound = setInterval(function () { $("#audio-notify")[0].play(); }, 3000);
    }

    toastr.info(data.title, data.text, {
        extendedTimeOut: 0,
        timeOut: 0,
        positionClass: "toast-bottom-right",
        onclick: function () {
            if(current_route === "dashboard"){
                EventBus.$emit('notification', data);
            }else{
                localStorage.setItem('data', JSON.stringify(data));
                window.location.replace(`/dashboard`);
            }
        }
    });
}

EventBus.$on('stopSound', function () {
    console.log("stop sound");
    if (intervalSound != null) {
        clearInterval(intervalSound);
        intervalSound = null;
    }
});
