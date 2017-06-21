<script>

/* ---------------------------------------------------------------- *\

                            NODE MODEL

          MIXIN - Controls all functionality on the node object.

 \* ---------------------------------------------------------------- */

export default {

    methods: {






        node_add: function($nodetype) {
            console.log('Node Type :' + $nodetype);

            var currentpage = this.$root.currentpage[0].id

            var $nodepayload = {
                page_id : currentpage,
                node_type : $nodetype
            }

            this.makeCreateRequest( 'api/v1/node', $nodepayload)
                .then( function(successresponse) {
                    eventhub.$emit('addnodetolist', successresponse.data);
                    eventhub.$emit('flash', 'Node Created.', 'success', 'dot-circle-o');
                })
                .catch( function(errorresponse) {
                    eventhub.$emit('flash', 'Error. Unable to add node. Status: ' + errorresponse.status + '. ' + errorresponse.statusText, 'danger', 'exclamation-triangle');
                    console.log(errorresponse);
                });

        },





        node_delete: function() {

            this.makeDeleteRequest( 'api/v1/node/{id}', this.$root.selectednode.id)
                .then( function(successresponse) {
                    eventhub.$emit('removenodefromlist', this.$root.selectednode);
                    eventhub.$emit('resetblocks');
                    eventhub.$emit('flash', 'ReKeep Node Deleted', 'warn', 'trash');
                })
                .catch( function(response) {
                    eventhub.$emit('flash', 'Error. Node not Deleted.', 'danger', 'exclamation-triangle');
                });

            console.log('Node Deleted');
        },





        node_update: function() {

            var $nodepayload = {
                title :         this.$root.selectednode.title,
                description :   this.$root.selectednode.description
            }

            this.makeUpdateRequest( 'api/v1/node/{id}', this.$root.selectednode.id, $nodepayload)
                .then( function(successresponse) {
                    eventhub.$emit('flash', 'Node Saved.', 'success', 'floppy-o');
                })
                .catch( function(response) {
                    eventhub.$emit('flash', 'Error. Node not Updates.', 'danger', 'exclamation-triangle');
                });

            console.log('Node Updated');
        },






        node_create: function() {
            console.log('Method not created yet... ');
        },

    }

}

</script>