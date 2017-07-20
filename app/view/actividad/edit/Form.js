Ext.define('sisscsj.view.actividad.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.actividad.edit.form',
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
                            xtype: 'actividad.edit.tab.actividad',
                            title: 'Info. de Actividad'
                        },
                        {
                            xtype: 'actividad.edit.tab.tipoactividad',
                            title: 'Tipo de Actividad'
                        },
                        {
                            xtype: 'actividad.edit.tab.subarea',
                            title: 'Sub-Área de Actividad'
                        },
                        {
                            xtype: 'actividad.edit.tab.beneficiarios',
                            title: 'Participantes'
                        },
                        {
                            xtype: 'actividad.edit.tab.personal',
                            title: 'Personal'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});