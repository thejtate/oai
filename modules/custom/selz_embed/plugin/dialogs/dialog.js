(function () {

    var plugin_name = 'selz_embed'
        , img_class = 'cke_' + plugin_name
        , tag_name = 'em'
        , inner_text = 'SELZ'
        , result_class = 'site_' + plugin_name + '_anchor'
        , obj_kind = plugin_name
        , data_attr = 'data-plugin';

    CKEDITOR.dialog.add(plugin_name, function (editor) {

        var commit = function (styles, attrs) {
            var value = this.getValue();

            attrs[this.id] = value;
        };

        var load = function (cfg) {
            this.setValue(cfg[this.id]);
        };

        var getClickChoseHandler = function(id) {
            return function () {
                editor.getColorFromDialog(function (color) {
                    if (color)
                        this.getDialog().getContentElement('tab-adv', id).setValue(color);
                    this.focus();
                }, this);
            }
        };

        var getClickChoseDefaultHandler = function(id, defaultColor) {
            return function () {
                this.getDialog().getContentElement('tab-adv', id).setValue(defaultColor);
            }
        };

        var colorElements = function(elementsInfo) {
            var elements = [];
            for (var i = 0; i < elementsInfo.length; i++) {

                elements.push(
                    {
                        type: 'hbox',
                        padding: 0,
                        widths: ['50%', '25%', '25%'],
                        children: [{
                            type: 'text',
                            id: elementsInfo[i].id,
                            label: elementsInfo[i].label,
                            'default': elementsInfo[i].default,
                            commit: commit,
                            setup: load
                        },
                            {
                                type: 'button',
                                id: elementsInfo[i].id + '_choose',
                                'class': 'colorChooser',
                                label: 'Choose',

                                'default': elementsInfo[i].default,
                                onLoad: function () {
                                    this.getElement().getParent().setStyle('vertical-align', 'bottom');
                                    this.setValue('#ccff33');
                                },
                                onClick: getClickChoseHandler(elementsInfo[i].id),
                                setup: function (cfg) {
                                    this.setValue('#ccff33');
                                }
                            },
                            {
                                type: 'button',
                                id: elementsInfo[i].id + '_choose',
                                'class': 'defaultColorChooser',
                                label: 'Set Default',
                                style: 'margin-right: 10px',
                                onLoad: function () {
                                    this.getElement().getParent().setStyle('vertical-align', 'bottom');
                                },
                                onClick: getClickChoseDefaultHandler(elementsInfo[i].id, elementsInfo[i].default)
                            }
                        ]
                    }
                );
            }
            return elements;
        };

        var setElementsVisibility = function (type, context) {
            var dialog = CKEDITOR.dialog.getCurrent();
            var document = context.getElement().getDocument();
            switch (type) {
                case 'button':
                    dialog.getContentElement('tab-general', 'position').getElement().show();
                    dialog.getContentElement('tab-general', 'show_logos').getElement().hide();
                    dialog.getContentElement('tab-general', 'interact').getElement().show();
                    document.getById('item-url-description').show();
                    document.getById('store-url-description').hide();
                    break;
                case 'widget':
                    dialog.getContentElement('tab-general', 'position').getElement().hide();
                    dialog.getContentElement('tab-general', 'show_logos').getElement().show();
                    dialog.getContentElement('tab-general', 'interact').getElement().show();
                    document.getById('item-url-description').show();
                    document.getById('store-url-description').hide();
                    break;
                case 'store':
                    dialog.getContentElement('tab-general', 'position').getElement().hide();
                    dialog.getContentElement('tab-general', 'show_logos').getElement().hide();
                    dialog.getContentElement('tab-general', 'interact').getElement().hide();
                    document.getById('item-url-description').hide();
                    document.getById('store-url-description').show();
                    break;
            }
        };

        //var colorDialog = editor.plugins.colordialog;
        return {
            title: 'Selz Widget Options',
            minWidth: 400,
            minHeight: 300,
            contents: [
                {
                    id: 'tab-general',
                    label: 'General',
                    elements: [
                        // UI elements of the first tab will be defined here.
                        {
                            type: 'select',
                            id: 'type',
                            label: 'Widget type',
                            items: [['Button', 'button'], ['Widget', 'widget'], ['Store', 'store']],
                            'default': 'button',
                            commit: commit,
                            setup: load,
                            onChange: function (api) {
                                setElementsVisibility(this.getValue(), this);
                            }
                        },
                        {
                            type: 'text',
                            id: 'url',
                            label: 'URL',
                            validate: CKEDITOR.dialog.validate.regex(/^(https?):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i, 'Invalid URL'),
                            commit: commit,
                            setup: load
                        },
                        {
                            type: 'html',
                            html: '<div id="item-url-description">PRODUCT URL: Go to "Share" on one of your item tiles<br>  on the dashboard (under options) and copy <br>  the short link e.g http://selz.co/123abc4</div>'
                        },
                        {
                            type: 'html',
                            html: '<div id="store-url-description">STORE URL: Go to <a href="https://selz.com/settings/embedstore?tab=link" target="_blank" style="text-decoration: underline;">embed store</a> <br> and copy the link e.g. https://mystore.selz.com </div>'
                        },
                        {
                            type: 'select',
                            id: 'position',
                            label: 'Button style',
                            items: [['Price on right', 'default'], ['Price above', 'above']],
                            'default': 'default',
                            commit: commit,
                            setup: load
                        },
                        {
                            type: 'checkbox',
                            id: 'show_logos',
                            label: 'Show Payment logos',
                            commit: commit,
                            setup: load
                        },
                        {
                            type: 'select',
                            id: 'interact',
                            label: 'Button style',
                            items: [['Overlay', 'modal'], ['New tab', 'blank']],
                            'default': 'modal',
                            commit: commit,
                            setup: load
                        }
                    ]
                },
                {
                    id: 'tab-adv',
                    label: 'Colors',
                    elements: colorElements([
                        {id: 'background_color', label: 'Background color', default: '#6D48CC'},
                        {id: 'text_color', label: 'Text color', default: '#FFFFFF'},
                        {id: 'link_color', label: 'Link color', default: '#6D48CC'},
                        {id: 'chbg_color', label: 'Checkout header background', default: '#6D48CC'},
                        {id: 'chtx_color', label: 'Checkout header text', default: '#FFFFFF'}
                    ])
                }
            ],
            onShow: function () {
                 //Clear previously saved elements.
                this.fake = this.node = null;

                var fake = this.getSelectedElement();
                if (fake && fake.data('cke-real-element-type') === 'selz_embed') {
                    this.fake = fake;
                    this.node = editor.restoreRealElement(fake);
                    var cfg = JSON.parse(this.node.getAttribute(data_attr))
                    this.setupContent(cfg);
                }
                var dialog = CKEDITOR.dialog.getCurrent();
                setElementsVisibility(dialog.getContentElement('tab-general', 'type').getValue(), this);
            },
            onOk: function () {

                if (!this.fake) {
                    var html =
                        '<cke:' + tag_name + '>' +
                        inner_text +
                        '</cke:' + tag_name + '>';
                    var node = CKEDITOR.dom.element
                        .createFromHtml(html, editor.document);
                    node.addClass(result_class);
                }
                else {
                    var node = this.node;
                }

                // collect values
                var styles = {}, attrs = {};
                this.commitContent(styles, attrs);

                // prepare node
                node.setStyles(styles);
                node.$.setAttribute(data_attr, JSON.stringify(attrs));

                // prepare new fake_object
                var new_fake = editor.createFakeElement(node, img_class, 'selz_embed', true);
                new_fake.setAttributes(attrs);
                new_fake.setStyles(styles);

                // save
                if (this.fake_image) {
                    new_fake.replace(this.fake);
                    editor.getSelection().selectElement(new_fake);
                }
                else {
                    editor.insertElement(new_fake);
                }
            }
        };
    });


})();