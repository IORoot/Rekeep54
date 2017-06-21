<div class="rk-settings rk-settings__pagedetails" v-show="showpagesettings.viewable" transition="rk-settings--fade">

    <div class="rk-menutabs">
        <button class="rk-button" @click="togglemenu('showmenusettings')"><i class="fa fa-folder-o" aria-hidden="true"></i></button>
        <button class="rk-button" @click="togglemenu('showpagesettings')"><i class="fa fa-tasks" aria-hidden="true"></i></button>
        <button class="rk-button rk-r" @click="toggleblock('closeBox')"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
    </div>

    <div class="rk-settings__content">

        <h1 class="rk-settings__title">Page Settings.</h1>

        <div id="pageTitle">Title: @{{ selectedpage.title }}</div>
        <div id="pageID">ID: [@{{ selectedpage.id }}]</div>

        <!-- <div id="pagePublic">Public: @{{ selectedpage.public }}</div> -->
        Public: <input class="rk-form__text" v-model="selectedpage.public">
        <div id="pageBackgroundHex" v-bind:style="{color: '#' + selectedpage.background_hex }">Background Hex: @{{ selectedpage.background_hex }}</div>
        <div id="pageBackgroundImage">Background Image: @{{ selectedpage.background_image }}</div>
        <div id="pageFilter">Filter: @{{ selectedpage.page_filter }}</div>

        <div id="pageDateCreated">Created: @{{ selectedpage.created_at }}</div>
        <div id="pageDateUpdated">Updated: @{{ selectedpage.updated_at }}</div>

        <div id="pageGridDirection">Grid Direction: @{{ selectedpage.grid_driection }}</div>
        <div id="pageGridColumnCount">Grid Columns: @{{ selectedpage.grid_column_count }}</div>
        <div id="pageGridRowHeight">Grid Row Height: @{{ selectedpage.grid_row_height }}</div>
        <div id="pageNodeSize">Node Size: @{{ selectedpage.default_node_size }}</div>

        <div id="pagePrimaryHex" v-bind:style="{color: '#' + selectedpage.default_primary_hex }">Primary Hex: @{{ selectedpage.default_primary_hex }}</div>
        <div id="pageSecondaryHex" v-bind:style="{color: '#' + selectedpage.default_secondary_hex }">Secondary Hex: @{{ selectedpage.default_secondary_hex }}</div>

        <div id="pageOrder">Page Order: @{{ selectedpage.page_order }}</div>
        <div id="pagePresentation">Page Presentation: @{{ selectedpage.page_presentation }}</div>
        <div id="pageRating">Page Rating: @{{ selectedpage.rating }}</div>

    </div>
</div> <!-- END .rk-settings -->