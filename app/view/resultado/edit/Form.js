Ext.define('sisscsj.view.resultado.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.resultado.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'Ext.ux.form.ItemSelector'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 3
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 0,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'resultado.edit.tab.resultado',
                            title: 'Info. de Resultado (Paso 1)'
                        },
                        {
                            xtype: 'resultado.edit.tab.resultado2',
                            title: 'Info. de Resultado (Paso 2)'
                        },
                        {
                            xtype: 'resultado.edit.tab.resultado3',
                            title: 'Info. de Resultado (Paso 3)'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});