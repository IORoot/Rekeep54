<script>

/* ---------------------------------------------------------------- *\

                            USERMENU MODEL

        MIXIN - Controls all functionality on the usermenu object.

 \* ---------------------------------------------------------------- */

export default {

    methods: {




        usermenu_add: function() {

            if (this.$root.currentpage != "") {                                                     // Grab the current page ID and set it to a variable.
                var currentselection = this.$root.currentpage[0].id
            } else {
                var currentselection = null
            }

            var $menupayload = {
                menu_id : currentselection
            }

            this.makeCreateRequest( 'api/v1/usermenu', $menupayload)
                .then( function(successresponse) {
                    eventhub.$emit('flash', 'Folder Created.', 'success', 'folder');
                    eventhub.$emit('setmenutreedata', successresponse.data);
                })
                .catch( function(errorresponse) {
                    eventhub.$emit('flash', 'Error. Unable to add folder. Status: ' + errorresponse.status + '. ' + errorresponse.statusText, 'danger', 'exclamation-triangle');
                    console.log(errorresponse);
                });

        },




        usermenu_delete: function() {
            this.makeDeleteRequest( 'api/v1/usermenu/{id}', this.$root.selectedmenu.id)
                .then( function(successresponse) {
                    eventhub.$emit('setmenutreedata', successresponse.data);
                    eventhub.$emit('resetblocks');
                    eventhub.$emit('flash', 'Menu Removed.', 'warn', 'trash');
                })
                .catch( function(response) {
                    eventhub.$emit('flash', 'Error. Menu was not Removed.', 'danger', 'exclamation-triangle');
                });
        },





        usermenu_update: function() {
            console.log('Usermenu Updated');
        },




        usermenu_create: function() {
            console.log('Usermenu Created');
        },

    }

}

</script>