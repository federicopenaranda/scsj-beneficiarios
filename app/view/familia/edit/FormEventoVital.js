Ext.define('sisscsj.view.familia.edit.FormEventoVital', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.formeventovital',
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
                            name: 'fk_id_tipo_evento_vital',
                            fieldLabel: 'Tipo de Evento Vital:',
                            displayField: 'nombre_tipo_evento_vital',
                            valueField: 'id_tipo_evento_vital',
                            store: {
                                type: 'opciones.tipoeventovital'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_evento_vital_familia',
                            fieldLabel: 'Fecha del Evento Vital:',
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
                            name: 'observaciones_evento_vital_familia',
                            fieldLabel: 'Observaciones del Evento Vital',
                            height: 80
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});