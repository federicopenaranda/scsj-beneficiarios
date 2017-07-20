/**
 * Formulario para crear ocupaciones
 */
Ext.define('sisscsj.view.beneficiario.edit.FormTrabajo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.beneficiario.edit.formtrabajo',
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
                            xtype: 'numberfield',
                            name: 'monto_ingreso_beneficiario_trabajo',
                            fieldLabel: 'Monto por Trabajo:',
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'tipo_trabajo_beneficiario_trabajo',
                            fieldLabel: 'Tipo de Trabajo:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreTipoTrabajo,
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
                            xtype: 'combo',
                            name: 'estado_beneficiario_trabajo',
                            fieldLabel: 'Estado:',
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
                            name: 'descripcion_beneficiario_trabajo',
                            fieldLabel: 'Observaciones Trabajo',
                            height: 150
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});