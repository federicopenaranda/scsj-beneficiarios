Ext.define('sisscsj.view.familia.edit.FormServicioBasico', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.formserviciobasico',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
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
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_servicio_basico',
                            fieldLabel: 'Servicio Básico:',
                            displayField: 'nombre_servicio_basico',
                            valueField: 'id_servicio_basico',
                            store: {
                                type: 'opciones.serviciobasico'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_familia_servicio_basico',
                            fieldLabel: 'Estado Servicio Básico:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreEstado,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'observacion_familia_servicio_basico',
                            fieldLabel: 'Observaciones Servicio Básico'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});