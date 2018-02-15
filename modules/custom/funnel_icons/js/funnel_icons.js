(function ($) {

    var icons = [];
    $.each($.funnel_icons, function(i, iconset) {
        $.each(iconset.icons, function(j, v) {
            if(v) {
                icons.push( iconset.iconClass + ' ' + iconset.iconClassFix + v);
            }
        });
    });

    Drupal.behaviors.funnelIcons = {
        attach: function (context, settings) {

                // Init the font icon picker
                var e8_element = $('.fnl-iconpicker').once('fnl-iconpicker').fontIconPicker({
                    theme: 'fip-grey'
                }).setIcons(icons);

        }
    };
})(jQuery);
