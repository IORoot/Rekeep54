/*
 * TEMPLATE - Tab Panel
 */
<template id="rk-tabs">

    <div>
        <div class="rk-tabs" >
            <ul>
                <li v-for="RkTab in RkTabs" >
                    <a
                        :class="{'is-active' : RkTab.isActive}"
                        @click="selectTab(RkTab)"
                        href="#">
                            {{ RkTab.name }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="rk-tab">
            <slot></slot>
        </div>
    </div>

</template>


/*
 * SERVICE - TAB PANEL
 */

<script>
export default {

    name: 'rk-tabs',

    template: '#rk-tabs',

    data() {
        return {
            RkTabs: []
        };
    },

    created() {
        this.RkTabs = this.$children;
    },

    methods: {

        selectTab(selectedTab) {
            this.RkTabs.forEach(RkTab => {
                RkTab.isActive = (RkTab.name == selectedTab.name)
            })
        }

    },


}
</script>