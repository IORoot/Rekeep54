<ul class="rk-menutree" @click.self="currentNULL()">
    <rk-menutree v-for="currentnode in menutreedata" :currentnodedata="currentnode" :key="currentnode.id"></rk-menutree>
</ul>