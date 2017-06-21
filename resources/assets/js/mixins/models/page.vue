<script>

/* ---------------------------------------------------------------- *\

 NODE MODEL

 MIXIN - Controls all functionality on the page object.

 \* ---------------------------------------------------------------- */

export default {

    methods: {

        page_add: function() {
            console.log('Page Added');
        },







        page_delete: function() {
            console.log('Page Deleted');
        },





        page_update: function() {

            var $pagepayload = {
                title :     this.$root.selectedmenu.title
            }

            var $menupayload = {
                title :     this.$root.selectedmenu.title,
                icon_name : this.$root.selectedmenu.icon_name,
                icon_hex :  this.$root.selectedmenu.icon_hex
            }

            this.makeUpdateRequest( 'api/v1/page/{id}', this.$root.selectedmenu.id, $pagepayload)
                .catch( function(errorresponse) {
                    eventhub.$emit('flash', 'Error. Page not Created.', 'danger', 'exclamation-triangle');
                });

            this.makeUpdateRequest( 'api/v1/usermenu/{id}', this.$root.selectedmenu.id, $menupayload)
                .then( function(successresponse) {
                    eventhub.$emit('flash', 'Menu Saved.', 'success', 'floppy-o');
                })
                .catch( function(response) {
                    eventhub.$emit('flash', 'Error. Menu not created.', 'danger', 'exclamation-triangle');
                });
        },






        page_create: function() {
            console.log('Page Created');
        },

    }

}

</script>