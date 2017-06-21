/*
 * TEMPLATE - SIDEMENU TREE
 *
 * A self-calling template that will render the sidemenu for the App.
 *
 * Utilises AJAX calls in the ../mixins/ajaxservice.vue service.
 *
*/
<template id="rk-menutree">
    <li class="rk-menutree__list-item" draggable="true">
        <div class="rk-menutree__menu-item"
            :class="{ 'rk-menutree__menu-item_current-folder' : isCurrent }"
            @click.self="toggleFolder"
            @mouseenter="mousehover = ! mousehover"
            @mouseleave="mousehover = ! mousehover ">

            <span class="rk-menutree__menu-icon fa"
                :class="currentnodedata.icon_name"
                :style="{color: '#' + currentnodedata.icon_hex }" >
            </span>

            <span class="rk-menutree__menu-title"
                :class="{ 'rk-menutree__menu-title_is-folder' : isFolder, 'rk-menutree__menu-title_is-current' : isCurrent }"
                @click="fetchPage()">
                {{ currentnodedata.title }}
            </span>

            <span class="fa"
                :class="folderopen ? 'fa-angle-down' : 'fa-angle-double-right'"
                @click.self="toggleFolder"
                v-if="isFolder">
            </span>

            <span class="rk-menutree__settings-icon"
                @click="fetchPageSettings()"
                v-if="mousehover">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </span>

            <span class="rk-menutree__drag-icon"
                v-if="mousehover">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
        </div>

        <ul v-if="isFolder"
            v-show="folderopen"
            class="rk-menutree__sub-menu">
            <rk-menutree v-for="currentnode in currentnodedata.children"
                :currentnodedata="currentnode"
                :key="currentnodedata.children">
            </rk-menutree>
        </ul>
    </li>
</template>


<script>
/*
 * COMPONENT - SIDEMENU MENUTREE
 *
 * Controls the functionality of the sidemenu and multi-level tree.
 *
 * @data folderopen             determines if the current folder is open or not.
 * @data mousehover             determines if the mouse is currently hovering over this instance of the usermenu
 * @data currentnodeid          is the ID of the current node in this instance.
 *
 * @property currentnodedata    holds a JSON object of all the current data
 *
 * @computed isFolder           is a property which determines if the current menuitem has children nodes or not.
 * @computed isCurrent          is a property that determines if this instance is the current one being loaded (has been clicked on).
 *
 * @method fetchPage            AJAX call to retrieve a page & all nodes for this particular menuitem. Can also be supplied an ID for any page.
 * @method fetchPageSettings    AJAX call to retrieves the page settings for this item.
 * @method setProperty          AJAX call to set any particular property on the current instance of the menuitem
 * @method toggleFolder         reverses the current value of @data folderopen.
 * @method currentNULL          select no folders so a root level folder can be created.
 */

    export default {

        name: 'rk-menutree',

        template: '#rk-menutree',

        data: function () {
            return {
                folderopen:         this.currentnodedata.state,
                mousehover:         false,
                currentnodeid:      this.currentnodedata.id,
            }
        },

        props: {
            currentnodedata:        '',
        },

        computed: {

            isFolder: function() {
                if (this.currentnodedata.children.length > 0 ){ return true; } else { return false; }
            },


            isCurrent: function() {

                if (this.$root.currentpage) {

                    if (this.currentnodeid == this.$root.currentpage[0].id) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            },


        },

        /*
        events: {

            'refreshPage': function(){
                this.fetchPage();
            }

        },
        */

        methods: {

            /*
             * AJAX Method to retrieve the USERMENU's PAGE and corresponding NODEs on that PAGE from the API.
            */
            fetchPage: function() {

                this.makeGetRequest('api/v1/usermenu/{id}/page', { id: this.currentnodeid }, {api_token: api_token} )
                    .then( function(response) {

                        eventhub.$emit('currentpagedetails', response.data);

                        this.makeGetRequest('api/v1/page/{id}/nodes', { id: response.data[0].id }, {api_token: api_token} )
                            .then( function(response) {
                                eventhub.$emit('currentnodelist', response.data);
                            });
                    });
            },

            /*
             * AJAX Method to fetch the PAGE settings from the API.
             */
            fetchPageSettings: function() {
                eventhub.$emit('toggleblocks', 'showmenusettings' , 'MS'+ this.currentnodeid);

                this.makeGetRequest('api/v1/usermenu/{id}/page', { id: this.currentnodeid }, {api_token: api_token} )
                    .then( function(response) {
                        eventhub.$emit('selectedpagedetails', [response.data, this.currentnodedata]);
                    });

            },

            /*
             * Change a property on the database. Supply a new value for a column to the API.
             */
            setProperty: function(property, newvalue) {

                var $payload = {
                    [property] :     newvalue
                }

                this.makeUpdateRequest( 'api/v1/usermenu/{id}', this.currentnodeid, $payload)
                    .catch( function(response) {
                        alert('Unable to SET property on database' + JSON.stringify(returnedresponse));
                    });
            },

            /*
             * Toggle the open/closed property on the node folder by using the setProperty method.
             */
            toggleFolder: function(){
                this.folderopen = ! this.folderopen;
                if (this.currentnodedata.state == 1) {
                    this.currentnodedata.state = 0;
                } else {
                    this.currentnodedata.state = 1;
                };

                this.setProperty('state', this.currentnodedata.state);
            }

        },
    }

</script>