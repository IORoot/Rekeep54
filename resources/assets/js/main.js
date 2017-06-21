// Browserify entrypoint
var Vue = require('vue');
var marked = require('marked');


window.Vue = Vue;

// VUE 2.0 Event HUB is for replacement of $dispatch method.
window.eventhub = new Vue();

// Use vue-resource for AJAX Requests.
Vue.use( require('vue-resource') );
// Use vue-moment for human readable date/time formatting.
Vue.use( require('vue-moment') );

    // Mixins

    // Import GLOBAL Mixins. (All components have access to functionality)
    import ajaxservice from './mixins/API_mixin.vue';
    Vue.mixin(ajaxservice);

    //  Mixins for Root (Components have to declare if they want to use them or not)
    import togglemixin from './mixins/toggle_mixin.vue';

    // Import MODELS as Mixins to Root (To use like traits)
    import node from './mixins/models/node.vue';
    import page from './mixins/models/page.vue';
    import usermenu from './mixins/models/usermenu.vue';

    // Components
    import RkFlashmessage from './components/rk-flashmessage.vue';
    import RkPanel from './components/rk-panel.vue';
    import RkButton from './components/rk-button.vue';
    import RkMenutree from './components/rk-menutree.vue';
    import RkNodeWebsite from './components/rk-node-website.vue';
    import RkNodeText from './components/rk-node-text.vue';
    import RkTabs from './components/rk-tabs.vue';
    import RkTab from './components/rk-tab.vue';


/*
 * ROOT VUE INSTANCE
 *
 */


new Vue ({

    el: '.rk-app',

    mixins: [
        togglemixin,
        usermenu,
        page,
        node,
        ajaxservice
    ],

    components: {
        'rk-button':        RkButton,
        'rk-flashmessage':  RkFlashmessage,
        'rk-panel':     RkPanel,
        'rk-menutree':      RkMenutree,
        'rk-node-website':  RkNodeWebsite,
        'rk-node-text':     RkNodeText,
        'rk-tabs':          RkTabs,
        'rk-tab':           RkTab,
    },

    data: {
        menutreedata:       menuJSON,

        selectedmenu:       '',

        currentpage:        '',
        selectedpage:       '',

        currentnodes:       '',
        selectednode:       '',

    },

    mounted() {

        var self = this; // Retain the global scope.

        eventhub.$on('currentpagedetails', function(currentpagedetails){
            self.currentpage = currentpagedetails;
        }),

        /*
         * NODE-Level events
         */
        eventhub.$on('currentnodelist', function(retrievednodes){
            self.currentnodes = retrievednodes;
        }),

        eventhub.$on('addnodetolist', function(addnode){
            self.currentnodes.push(addnode);
        }),

        eventhub.$on('removenodefromlist', function(deletednode){
            self.currentnodes.$remove(deletednode);
        }),

        eventhub.$on('refreshPage', function(){
            eventhub.$emit('refreshPage');
        }),

        eventhub.$on('selectednodedetails', function(selectednode){
            self.selectednode = selectednode;
        }),

        /*
         * PAGE-Level events
         */
        eventhub.$on('selectedpagedetails', function(selectedpagedetails){
            self.selectedpage = selectedpagedetails[0][0];
            self.selectedmenu = selectedpagedetails[1];
        }),

        /*
         * MENU-Level events
         */
        eventhub.$on('setmenutreedata', function(newmenutreedata){
            self.menutreedata = newmenutreedata;
        })


    },

    methods: {

        /*
         * Select no menu items (to add a new folder at root level)
         */
        currentNULL: function(){
            this.$root.currentpage = '';
        },

        /*
         * Looks at the colour passed (background colour) and
         * determines whether to use black or white as a font colour.
         */
        reverseFontColour: function(hexcolor){
            if (hexcolor) {
                var r = parseInt(hexcolor.substr(0,2),16);
                var g = parseInt(hexcolor.substr(2,2),16);
                var b = parseInt(hexcolor.substr(4,2),16);
                var yiq = ((r*299)+(g*587)+(b*114))/1000;
                return (yiq >= 128) ? '000000' : 'FFFFFF';
            }
            return 'FFFFFF';
        }
    }

});
