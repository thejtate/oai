/**
 * Created by dimateus on 04/07/16.
 */

(function () {

    var plugin_name = 'selz_embed'
        , img_class = 'cke_' + plugin_name
        , result_class = 'site_' + plugin_name + '_anchor'
        , tag_name = 'em'
        , priority = 1
        , obj_kind = plugin_name;

    var create_fake_element = function (editor, real_el) {
        return editor.createFakeParserElement(real_el, img_class, obj_kind, true);
    };

    CKEDITOR.plugins.add(plugin_name,
        {
            requires: ['dialog', 'fakeobjects'],
            onLoad: function () {
                var css = 'img.' + img_class +
                    '{' +
                    '	-moz-box-sizing: border-box;' +
                    '	-webkit-box-sizing: border-box;' +
                    '	box-sizing: border-box;' +
                    '	background: url(' + this.path + 'img/selz.png) ' +
                    'no-repeat center center white;' +
                    '	border: 1px solid #a9a9a9;' +
                    '	min-width: 100px;' +
                    '	min-height: 50px;' +
                    '	margin: 5px 0 10px 0;' +
                    '}';

                CKEDITOR.addCss(css);
            },
            init: function (editor) {

                var req = tag_name /* tag */ + '[!data-plugin]' /* attrs */ +
                    '(' + result_class + ')';

                editor.addCommand(plugin_name, new CKEDITOR.dialogCommand(plugin_name, {allowedContent: req}));

                editor.ui.addButton(plugin_name,
                    {
                        label: 'Selz',
                        icon: this.path + 'img/icon.png',
                        command: plugin_name
                    });

                CKEDITOR.dialog.add(plugin_name, this.path + 'dialogs/dialog.js');

                editor.on('doubleclick', function (e) {
                    var element = e.data.element;

                    if (element.is('img') &&
                        element.data('cke-real-element-type') === plugin_name) {
                        e.data.dialog = plugin_name;
                    }
                });

            },
            afterInit: function (editor) {
                var dataProcessor = editor.dataProcessor,
                    dataFilter = dataProcessor && dataProcessor.dataFilter;

                if (!dataFilter) {
                    return;
                }

                var elements = {};
                elements[tag_name] = function (el) {
                    if (el.classes && el.classes.indexOf(result_class) !== -1) {
                        return create_fake_element(editor, el);
                    }

                    return null;
                };
                dataFilter.addRules({elements: elements}, priority);
            }
        });
}());