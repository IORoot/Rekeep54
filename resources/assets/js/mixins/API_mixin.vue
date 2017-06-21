/*
 * SERVICE - AJAX COMMUNICATIONS
 *
 * Handles all of the API AJAX calls using vue-resource.
 */

<script>

    export default {

        methods: {


            /* ---------------------------------------------------------------- *\

                                    OUTGOING REQUESTS

            \* ---------------------------------------------------------------- */


            /*
             * makeGetRequest
             *
             * send a GET request to a resource with the correct options.
             *
             */
            makeGetRequest: function($resourceURL, $wildcardValue, $params) {

                var newresource = this.$resource($resourceURL);

                return newresource.get($wildcardValue, $params)
                    .then(
                        function(response) {
                            return response;
                        }
                    )
                    .catch(
                        function(error){
                            console.log('makeGetRequest is REEEJECTED!');
                        }
                    );
            },


            /*
             * makeUpdateRequest
             *
             * send a GET request to a resource with the correct options.
             *
             */
            makeUpdateRequest: function($resourceURL, $id, $payload ) {

                var newresource = this.$resource($resourceURL);

                return newresource.update(
                    { id: $id },
                    {
                        payload: $payload,
                        api_token: api_token
                    }
                ).then(
                    function(response) {
                        return response;
                    }
                );

            },


            /*
             * makeCreateRequest
             *
             * send a POST request to a resource with the correct options to create a new model object
             *
             */
            makeCreateRequest: function($resourceURL, $payload ) {

                $payload.api_token = api_token;

                var newresource = this.$resource($resourceURL);

                return newresource.save(
                    $payload
                ).then(
                    function(response) {
                        return response;
                    }
                );

            },


            /*
             * makeDeleteRequest
             *
             * send a DELETE request to a resource with the correct ID to remove the resource.
             *
             */
            makeDeleteRequest: function($resourceURL, $id ) {

                var deleteresource = this.$resource($resourceURL);

                return deleteresource.delete(
                    { id: $id },
                    {
                        api_token: api_token
                    }
                ).then(
                    function(response) {
                        return response;
                    }
                );

            }

            /* ---------------------------------------------------------------- *\

                                    INCOMING REQUESTS

            \* ---------------------------------------------------------------- */


        }

    }

</script>