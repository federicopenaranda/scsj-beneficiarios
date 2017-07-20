Ext.define('sisscsj.view.monitoreopc.MonitoreoPc.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.monitoreopc.monitoreopc.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.monitoreopc.MonitoreoPc.Lista',
        'sisscsj.view.monitoreopc.MonitoreoPc.edit.tab.Monitoreo',
        'sisscsj.view.monitoreopc.MonitoreoPc.edit.tab.Resultado'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'monitoreopc.ponitoreopc.edit.tab.monitoreo',
                            title: 'Monitoreo'
                        },
                        {
                            xtype: 'monitoreopc.ponitoreopc.edit.tab.resultado',
                            title: 'Resultado'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});