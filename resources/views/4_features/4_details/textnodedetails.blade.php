<!-- CLOSE WINDOW -->
<span class="rk-details__close-box" @click="toggleblock('closeBox')">&times;</span>

<!-- CONTAINER -->
<div class="rk-details__container" v-bind:style="{ color : '#000000' }">

    <!-- TITLE -->
    <h1><input type="text" class="rk-form__text rk-text-details__title" :value="selectednode.title" v-model="selectednode.title" ></input></h1>

    <!-- MARKDOWN DESCRIPTION -->
    <textarea class="rk-form__textarea_markdown" v-model="selectednode.description" >@{{ selectednode.description}}</textarea>



    <rk-tabs>

        <rk-tab name="Info" selected="true">

            <!-- Date Updated -->
            <rk-panel label="Last Updated">
                @{{ selectednode.updated_at }}
            </rk-panel>

        </rk-tab>





        <rk-tab name="Colour">

            <!-- Colour Palette -->
            <div class="rk-swatch-container">
                <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_1_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_1_hex }}</span></div>
                <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_2_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_2_hex }}</span></div>
                <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_3_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_3_hex }}</span></div>
                <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_4_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_4_hex }}</span></div>
                <div class="rk-swatch_mini" v-bind:style="{ background : '#' + selectednode.colour_5_hex }"><span class="rk-swatch__label_mini">@{{ selectednode.colour_5_hex }}</span></div>
            </div>
        </rk-tab>


    </rk-tabs>

</div><!-- END .nodeDetailsContainer -->

<rk-button v-on:do="node_delete" type="danger">Delete?</rk-button>
<rk-button v-on:do="node_update" type="info">Update</rk-button>

