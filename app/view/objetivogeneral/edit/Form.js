Ext.define('sisscsj.view.objetivogeneral.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.objetivogeneral.edit.form',
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
                            xtype: 'objetivogeneral.edit.tab.objetivogeneral',
                            title: 'Info. de Objetivo General'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});