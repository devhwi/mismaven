/*jslint browser: true */
/*global jQuery */

jQuery(function ($) {
    'use strict';

    function getKeyCombo(e) {
        var modifierNames = ['alt', 'ctrl', 'meta', 'shift'],
            i,
            numModifierNames = modifierNames.length,
            modifierName,
            modifierKeys = [],
            modifierKeysDisplay = '';

        for (i = 0; i < numModifierNames; i += 1) {
            modifierName = modifierNames[i];

            if (e[modifierName + 'Key']) {
                modifierKeys.push(modifierName);

                // upper case the first letter and add a "+"
                modifierKeysDisplay += modifierName.charAt(0).toUpperCase() + modifierName.slice(1) + '+';
            }
        }

        return {
            keyCode: e.keyCode,
            modifierKeys: modifierKeys,
            displayValue: modifierKeysDisplay + e.keyCode
        };
    }

    $('#tab_override_tab_key_combo').on('keydown.tabOverride', function (e) {
        var keyCombo;

        if (e.keyCode === 27) {
            $('.description', $(this).parent()).focus();
            return;
        }

        keyCombo = getKeyCombo(e);

        $('#tab_override_tab_key_code').val(keyCombo.keyCode);
        $('#tab_override_tab_key_modifiers').val(keyCombo.modifierKeys.join(','));
        this.value = keyCombo.displayValue;

        return false;
    });

    $('#tab_override_untab_key_combo').on('keydown.tabOverride', function (e) {
        var keyCombo;

        if (e.keyCode === 27) {
            $('.description', $(this).parent()).focus();
            return;
        }

        keyCombo = getKeyCombo(e);

        $('#tab_override_untab_key_code').val(keyCombo.keyCode);
        $('#tab_override_untab_key_modifiers').val(keyCombo.modifierKeys.join(','));
        this.value = keyCombo.displayValue;

        return false;
    });
});
