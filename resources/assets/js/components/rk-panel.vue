/*
 * TEMPLATE - Form Text box.
 */
<template id="rk-panel">

    <div class="rk-panel">
        <label class="rk-panel--label">
            {{ label }}
        </label>
        <div class="rk-panel--content">
            <slot></slot>
        </div>
    </div>

</template>


<script>
    export default {

        name: 'rk-panel',

        template: '#rk-panel',

        props: {

            label: {}

        },

    }
</script>