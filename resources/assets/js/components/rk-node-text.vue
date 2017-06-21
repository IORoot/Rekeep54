/*
 * TEMPLATE - CONTENT NODE
 *
 * A template for each node on the page.
 *
 */
<template id="rk-node-text">

    <div class="rk-results-item__content rk-textnode" v-show="visible" @click.stop="fetchNodeDetails(currentnode)">

        <div class="rk-textnode__description">{{ currentnode.description }}</div>

        <div class="rk-results-item__details">
            <div class="rk-results-item__colour-bar" v-bind:style="{ background : 'linear-gradient(45deg, #' + currentnode.colour_1_hex + ' , #' + currentnode.colour_2_hex + ')' }" ></div>
            <div class="rk-results-item__title">{{ currentnode.title }}</div>
            <div class="rk-results-item__date">{{ currentnode.updated_at | moment("from", "now") }}</div>
        </div>

    </div> <!-- END .flexcontainer__content-->

</template>


/*
 * COMPONENT - NODE
 *
 * Displays and controls each individual node.
 *
 */
<script>
export default {

    name: 'RkNodeText',

    template: '#rk-node-text',

    props: {
        currentnode: ''
    },

    data: function () {
        return {
            visible:     true,
        }
    },

    methods: {

        fetchNodeDetails: function(selectedNode) {
            eventhub.$emit('selectednodedetails', selectedNode);
            eventhub.$emit('toggleblocks', 'shownodedetails', 'ND'+selectedNode.id);
        }

    }
}

</script>