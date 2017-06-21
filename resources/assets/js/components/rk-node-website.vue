/*
 * TEMPLATE - CONTENT NODE
 *
 * A template for each node on the page.
 *
 * This had a gradient bar rather than a solid bar.
 * <div class="rk-results-item__colour-bar" v-bind:style="{ background : 'linear-gradient(45deg, #' + currentnode.colour_1_hex + ' , #' + currentnode.colour_2_hex + ')' }" ></div>
 *
 */
<template id="rk-node-website">

        <div class="rk-results-item__content rk-websitenode" v-show="visible" v-bind:style="{ background : 'linear-gradient(180deg, #' + currentnode.colour_1_hex + ' , #' + currentnode.colour_2_hex + ')' }" >

            <img class="rk-websitenode__image" :src="currentnode.image_filename" @click.stop="fetchNodeDetails(currentnode)" v-if="currentnode.image_filename">

            <div class="rk-results-item__details">
                <div class="rk-results-item__colour-bar" v-bind:style="{ background : '#' + currentnode.colour_1_hex}" ></div>
                <a :href="currentnode.url" target="_blank"><div class="rk-results-item__title">{{ currentnode.title }}</div></a>
                <div class="rk-results-item__date">{{ currentnode.updated_at | moment("from", "now") }}</div>
            </div>

        </div> <!-- END .rk-results__content-->

</template>


/*
 * COMPONENT - NODE
 *
 * Displays and controls each individual node.
 *
 */
<script>
export default {

    name: 'RkNodeWebsite',

    template: '#rk-node-website',

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