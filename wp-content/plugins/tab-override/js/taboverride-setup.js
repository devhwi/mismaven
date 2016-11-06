// Tab Override Setup Script v2.1.0
// Part of the Tab Override WordPress plugin

/*jslint browser: true */
/*global jQuery, tabOverrideParams, QTags, quickPressLoad: true, fullscreen: true */

(function ($) {
    'use strict';

    // booleans are true/false or "1"/""
    var params = tabOverrideParams,
        tabsEnabled = params.tabsDefault,
        quickPressLoadOrig,
        fullscreenOnOrig;

    // adds Tab Override to the quickPressLoad() function
    function quickPressLoadTabOverride() {
        quickPressLoadOrig();
        $(params.dashboardSelector).tabOverride();
    }

    // adds Tab Override to the fullscreen.on() method
    function fullscreenOnTabOverride() {
        fullscreenOnOrig();
        $(params.fullscreenSelector).tabOverride(tabsEnabled);
    }

    // settings
    $.fn.tabOverride
        .tabSize(parseInt(params.tabSize, 10))
        .autoIndent(params.autoIndent)
        .tabKey(parseInt(params.tabKeyCode, 10), params.tabKeyModifiers)
        .untabKey(parseInt(params.untabKeyCode, 10), params.untabKeyModifiers);

    // set Tab Override on the appropriate element(s) for the page type
    switch (params.pageType) {
    case 'dashboard':
        /*
        The QuickPress panel on the admin dashboard is now loaded via Ajax in WP 3.0.
        Setting Tab Override on window load will work only when the QuickPress panel
        is loaded by default. The global quickPressLoad function is executed when the
        panel is loaded. This is modified to include a call to Tab Override to ensure
        it is always set on the textarea regardless of when it is loaded.
        */
        $(window).on('load.wpTabOverridePlugin', function () {
            quickPressLoadOrig = quickPressLoad;
            quickPressLoad = quickPressLoadTabOverride;
            $(params.dashboardSelector).tabOverride();
        });
        break;
    case 'post':
        /*
        WordPress 3.2 introduced fullscreen mode for the HTML editor on the
        post and page edit pages. After the window is loaded, check for the
        global fullscreen object. If present, hook into the on() function and
        activate Tab Override for the #wp_mce_fullscreen textarea.
        */
        $(params.postSelector).tabOverride(tabsEnabled);
        $(window).on('load.wpTabOverridePlugin', function () {
            if (window.fullscreen && fullscreen.on) {
                fullscreenOnOrig = fullscreen.on;
                fullscreen.on = fullscreenOnTabOverride;
            }
        });

        // add a tabs on/off button to the HTML editor toolbar (WP 3.3+)
        if (params.tabsButton) {
            QTags.addButton(
                'tabs',
                tabsEnabled ? params.buttonOffValue : params.buttonOnValue,
                function (button) {
                    var vals = params;
                    if (button.value === vals.buttonOffValue) {
                        button.value = this.display = vals.buttonOnValue;
                        button.title = this.title = vals.buttonOnTitle;
                    } else {
                        button.value = this.display = vals.buttonOffValue;
                        button.title = this.title = vals.buttonOffTitle;
                    }
                    tabsEnabled = !tabsEnabled;
                    $(params.postSelector).tabOverride(tabsEnabled);
                },
                null,
                null,
                tabsEnabled ? params.buttonOffTitle : params.buttonOnTitle
            );
        }
        break;
    case 'editor':
        /*
        WordPress 3.0 added basic tabbing support to the theme and plugin editor
        pages. This interferes with Tab Override, so the corresponding event
        handlers must be removed before setting Tab Override on the textarea.
        This is done on window load since the event handlers are set up on documentready.
        */
        $(window).on('load.wpTabOverridePlugin', function () {
            // remove all events with the wpevent_InsertTab namespace (WP 3.2+)
            // and invoke Tab Override
            $(params.editorSelector).off('.wpevent_InsertTab').tabOverride();
        });
        break;
    default:
        $(params.otherSelector).tabOverride();
    }
}(jQuery));
