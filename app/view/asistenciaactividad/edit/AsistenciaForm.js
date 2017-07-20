Ext.define('sisscsj.view.asistenciaactividad.edit.AsistenciaForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.asistenciaactividad.edit.asistenciaform',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var hoy = new Date();
        hoy = Ext.util.Format.date(hoy, 'Y-m-d');
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
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
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'datefield',
                            name: 'fecha_asistencia',
                            fieldLabel: 'Fecha de Asistencia:',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'observaciones_asistencia',
                            fieldLabel: 'Observaciones de la Asistencia:'
                        }              
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});