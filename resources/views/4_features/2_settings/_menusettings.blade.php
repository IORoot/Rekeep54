<div class="rk-settings rk-settings__menutree"
     v-bind:style="{ left: showmenusettings.offcanvas + 'px' }"
     v-show="showmenusettings.viewable"
     transition="rk-settings--fade">

    <div class="rk-menutabs">
        <button class="rk-button" @click="togglemenu('showmenusettings')"><i class="fa fa-folder-o" aria-hidden="true"></i></button>
        <button class="rk-button" @click="togglemenu('showpagesettings')"><i class="fa fa-tasks" aria-hidden="true"></i></button>
        <button class="rk-button rk-r" @click="toggleblock('closeBox')"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
    </div>

    <div class="rk-settings__content">

        <h1 class="rk-settings__title">Menu Settings</h1>

        <span class="rk-settings__icon "><i class="fa" :class="selectedmenu.icon_name" v-bind:style="{color: '#' + selectedmenu.icon_hex }"></i></span>
        <input class="rk-form__text" v-model="selectedmenu.title">


        <a href="http://fontawesome.io/icons/" target="_blank"><i class="fa fa-font-awesome"></i> Icon Name:</a>
        <input class="rk-form__text" v-model="selectedmenu.icon_name">


        <!-- <input id="menuIconHex" type="color" class="rk-form--colour" v-bind:value="'#' + selectedmenu.icon_hex"> -->
        Icon Hex: <input class="rk-form__text" v-bind:style="{color: '#' + selectedmenu.icon_hex }" v-model="selectedmenu.icon_hex">

        <p>Menu Updated: @{{ selectedmenu.updated_at }}</p>

        <rk-button v-on:do="page_update" type="info">Update</rk-button>
        <rk-button v-on:do="usermenu_delete" type="danger">Delete?</rk-button>

    </div>


</div> <!-- END .rk-settings -->