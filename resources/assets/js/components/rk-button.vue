/*
 * TEMPLATE - Generic Button Component
 *
 * Properties:
 * type="success", "warn", "info", "danger", "success_light", "warn_light", "info_light", "danger_light"
 *
 * Methods:
 * :do="node_add"
 *
 * Method is name of event to trigger.
 *
 * Example:
 * <rk-button v-on:do="usermenu_add" type="info">Add Usermenu?</rk-button>
 */
<template id="rk-button">
    <button class="rk-button"
            :class="'rk-system__colour-' + type"
            aria-hidden="true"
            v-on:click.prevent="buttonClicked()">
        <slot></slot>
    </button>
</template>




/*
 * COMPONENT - Button
 *
 */
<script>
export default {

    name: 'rk-button',

    template: '#rk-button',

    props : [
        'type'
    ],

    methods: {

        buttonClicked: function(){
            this.$emit('do');    // Trigger the 'action' part of the button by 'emitting' the event.
        },

    }

}
</script>