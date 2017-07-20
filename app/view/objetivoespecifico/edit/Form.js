Ext.define('sisscsj.view.objetivoespecifico.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.objetivoespecifico.edit.form',
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
                            xtype: 'objetivoespecifico.edit.tab.objetivoespecifico',
                            title: 'Info. de Objetivo Específico (Paso 1)'
                        },
                        {
                            xtype: 'objetivoespecifico.edit.tab.objetivoespecifico2',
                            title: 'Info. de Objetivo Específico (Paso 2)'
                        },
                        {
                            xtype: 'objetivoespecifico.edit.tab.objetivoespecifico3',
                            title: 'Info. de Objetivo Específico (Paso 3)'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});