/*
 * TEMPLATE - Tab Details
 */
<template id="rk-tab">
    <div v-show="isActive"><slot></slot></div>
</template>


/*
 * SERVICE - TAB DETAILS
 */

<script>


export default {

    name: 'rk-tab',

    template: '#rk-tab',

    data() {
        return {
            isActive : false
        };
    },

    props: {

        name: {required: true},
        selected: {default: false}

    },

    mounted(){

        this.isActive = this.selected;
    }

}
</script>