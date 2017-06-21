<!-- CLOSE WINDOW -->
<span class="rk-details__close-box" @click="toggleblock('closeBox')">&times;</span>

<!-- IMAGE -->
<a target="_blank" :href="selectednode.url" v-if="selectednode.image_filename">
    <img class="rk-details__image" :src="selectednode.image_filename">
</a>

<!-- CONTAINER -->
<div class="rk-details__container" v-bind:style="{ color : '#' + reverseFontColour( selectednode.colour_1_hex ) }">

    <!-- TITLE -->
    <h1>
        <input type="text" class="rk-form__text rk-website-details__title" :value="selectednode.title" v-model="selectednode.title" ></input>
    </h1>


    <!-- Tab Panels -->
    <rk-tabs>

        <rk-tab name="Info" selected="true">

            <!-- NODE TYPE -->
            <rk-panel label="Node Type">
                @{{ selectednode.node_type }}
            </rk-panel>


            <!-- FAVICON -->
            <rk-panel label="Favicon URL">
                @{{ selectednode.favicon_url }}
            </rk-panel>


            <!-- URL -->
            <rk-panel label="Link URL">
                <a target="_blank" :href="selectednode.url">@{{ selectednode.url }}</a>
            </rk-panel>

            <!-- IMAGE URL -->
            <rk-panel label="Image Filename">
                <a target="_blank" :href="selectednode.image_filename">@{{ selectednode.image_filename }}</a>
            </rk-panel>


            <!-- DESCRIPTION -->
            <rk-panel label="Description">
                <textarea class="rk-form__textarea" v-model="selectednode.description" >@{{ selectednode.description }}</textarea>
            </rk-panel>


        </rk-tab>



        <rk-tab name="Notes">

            <!-- DESCRIPTION -->
            <rk-panel label="Notes">
                <textarea class="rk-form__textarea" v-model="selectednode.notes" >@{{ selectednode.notes }}</textarea>
            </rk-panel>

        </rk-tab>






        <rk-tab name="Meta">

            <rk-panel label="Twitter Link">
                @{{ selectednode.twitter_link }}
            </rk-panel>

            <rk-panel label="Facebook Link">
                @{{ selectednode.facebook_link }}
            </rk-panel>

            <rk-panel label="Youtube Link">
                @{{ selectednode.youtube_link }}
            </rk-panel>

            <rk-panel label="Instagram Link">
                @{{ selectednode.instagram_link }}
            </rk-panel>

        </rk-tab>





        <rk-tab name="RSS">
            Rss links goes in here...
        </rk-tab>



        <rk-tab name="View">


            <!-- Colours -->
            <rk-panel label="Colour Palette">
                <div class="rk-swatch-container">
                    <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_1_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_1_hex }}</span></div>
                    <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_2_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_2_hex }}</span></div>
                    <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_3_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_3_hex }}</span></div>
                    <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_4_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_4_hex }}</span></div>
                    <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_5_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_5_hex }}</span></div>
                </div>
            </rk-panel>


            <!-- Node Width -->
            <rk-panel label="Node Size (width x height)">
                @{{ selectednode.node_width }} x @{{ selectednode.node_height }}
            </rk-panel>


        </rk-tab>





        <rk-tab name="Settings">

            <rk-panel label="Last Updated">
                @{{ selectednode.updated_at }}
            </rk-panel>

            <rk-panel label="Click Count">
                @{{ selectednode.click_count }}
            </rk-panel>

        </rk-tab>




    </rk-tabs>

</div><!-- END .nodeDetailsContainer -->

<rk-button v-on:do="node_delete" type="danger">Delete?</rk-button>
<rk-button v-on:do="node_update" type="info">Update</rk-button>