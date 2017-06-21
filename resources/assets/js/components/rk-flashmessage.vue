/*
 * TEMPLATE - FLASH MESSAGING
 */
<template id="rk-flashmessage">

    <div class="alert rk-alert" :class="'rk-alert_' + type" v-show="show" transition="rk-alert--alert">
        <i class="fa  rk-alert__icon" :class="'fa-' + icon" aria-hidden="true"></i>

        <div class="rk-alert__message" :class="'rk-system__colour-' + type + '_light'">
            {{ message }}
            <button type="button" class="close rk-button" @click="closeMessage()" >&times;</button>
        </div>
    </div>

</template>


/*
 * SERVICE - FLASH MESSAGING
 */

<script>

export default {
    
    name: 'rk-flashmessage',

    template: '#rk-flashmessage',

    props: {

    },

    mounted: function(){

        var self = this; // Retain the global scope.
        eventhub.$on('flash', function(message, level, icon){
            self.flash(message, level, icon);
        })

    },


    data: function () {
        return {
            icon : 'exclamation',
            type : 'info',
            show : false,
            message : ''
        }
    },


    methods: {

        /*
         * flash
         *
         * create a flash message with appropriate colour and styling level.
         * $level can be: success, info, warn, danger
         *
         */
        flash: function(message, level, icon) {

            this.type = level;
            this.icon = icon;
            this.message = message;
            this.show = true;

            setTimeout( function() { this.show = false; }.bind(this) , 2500);
        },


        /*
         * Close the message.
         */
        closeMessage: function() {
            this.show = false;
        }
    }

}

</script>