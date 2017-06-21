/*
 * SERVICE - TOGGLING DIFFERENT VIEWS / PANELS OF THE APP
 *
 * Handles all of the opening / closing of the the different panels of the app.
 *
 * @data currentpage                object that holds the current page that is selected and loaded
 * @data currentnodes               array of objects of all nodes for the current loaded page
 *
 * @data selectedmenu               the currently selected menu (via the cog icon)
 * @data selectedpage               the currently selected page (via the cog icon)
 * @data selectednode               the currently selected node (via clicking the node)
 *
 * @data blockcaller                the name of the element that requested to open a panel. (Used to close again if clicked second time). e.g If the caller (MD123, ND567, etc) is the same, close the block.
 *
 * @data showsidebar                object holding status values for displaying opening/closing the sidebar depending on window size and @media queries
 * @data showpagesettings           object holding status values for displaying opening/closing the page settings depending on window size and @media queries
 * @data showpagesettings           object holding status values for displaying opening/closing the node settings depending on window size and @media queries
 * @data shownodedetails            object holding status values for displaying opening/closing the node details depending on window size and @media queries
 * @data sidebaroff                 toggle on whether the sidebar is viewable or not (switched off for mobile devices, so an off-canvas menu can be used)
 *
 * @method toggleblock              inverses the current values of the slide-in windows and blocks
 * @method switchoffblock           turns off a specific block
 * @method switchonblock            turns on a specific block
 * @method switchoffallotherblocks  turns off all other blocks except the one specified
 *
 */

<script>

export default {

    data: function() {
        return {

            blockcaller:        '',

            showsidebar : { viewable : false, offcanvas : -304, width : -304},
            showmenusettings : { viewable : false, offcanvas : -320, width : -320},
            showpagesettings :{ viewable : false, offcanvas : -320, width : -320},
            shownodedetails : { viewable : false, offcanvas : -320, width : -320},
            sidebaroff : -304,
        }
    },

    created() {

        var self = this;

        eventhub.$on('toggleblocks', function(blockname, blockcaller){
            self.toggleblock(blockname, blockcaller);
        }),

        eventhub.$on('resetblocks', function(){
            self.resetblocks();
        })
    },

    methods: {

        toggleblock: function($blockname, $blockcaller) {

            if ($blockcaller == this.blockcaller){
                this.switchoffblock($blockname);
                this.blockcaller = '';

            } else {
                this.blockcaller = $blockcaller;
                this.switchoffallotherblocks($blockname);
                if($blockname != "closeBox") {
                    this.switchonblock($blockname); 
                }
            }

        },

        togglemenu: function($blockname) {
            this.switchonblock($blockname);
            this.switchoffallotherblocks($blockname);
        },

        switchoffblock: function($blockname) {
            this[$blockname].viewable = false;
            this[$blockname].offcanvas = this[$blockname].width;
        },

        switchonblock: function($blockname) {
            this[$blockname].viewable = true;
            this[$blockname].offcanvas = 0;
        },

        switchoffallotherblocks: function($blockname) {
            if ($blockname != 'showsidebar')     { this.switchoffblock('showsidebar'); }
            if ($blockname != 'showmenusettings'){ this.switchoffblock('showmenusettings'); }
            if ($blockname != 'showpagesettings'){ this.switchoffblock('showpagesettings'); }
            if ($blockname != 'shownodedetails') { this.switchoffblock('shownodedetails'); }
        },

        resetblocks: function() {
            this.switchoffblock('showsidebar');
            this.switchoffblock('showmenusettings');
            this.switchoffblock('showpagesettings');
            this.switchoffblock('shownodedetails');
        }
    }

}

</script>