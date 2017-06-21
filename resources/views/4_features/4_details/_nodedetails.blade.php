<!-- TEXT NODE -->
<div class="rk-details rk-text-details"
     v-bind:style="{ right: shownodedetails.offcanvas + 'px' }"
     v-show="shownodedetails.viewable"
     transition="rk-details--fade"
     v-if=" selectednode.node_type == 'text' ">
    @include('4_features.4_details.textnodedetails')
</div>  <!-- END .rk-details -->

<!-- DEFAULT -->
<!-- Background image with gradient over the top! -->
<div class="rk-details rk-website-details"
     v-bind:style="{ right : shownodedetails.offcanvas + 'px ' }"
     v-show="shownodedetails.viewable"
     transition="rk-details--fade"
     v-else>
    @include('4_features.4_details.webnodedetails')
</div>  <!-- END .rk-details -->
