<div class="rk-results">
    <div class="rk-results-item"
         :class="{ 'rk-results-item_thin': shownodedetails.viewable }"
         v-for="node in currentnodes"
         :key="node.id">
        <rk-node-website :currentnode="node" v-if="node.node_type == 'website' "></rk-node-website>
        <rk-node-text    :currentnode="node" v-if="node.node_type == 'text'    "></rk-node-text>
    </div>
</div>