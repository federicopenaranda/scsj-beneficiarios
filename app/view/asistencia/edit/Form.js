Ext.define('sisscsj.view.asistencia.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.asistencia.edit.form',
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
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'asistencia.edit.tab.asistencia',
                            title: 'Info. de Asistencia'
                        },
                        {
                            xtype: 'asistencia.edit.tab.beneficiarios',
                            title: 'Beneficiarios'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});