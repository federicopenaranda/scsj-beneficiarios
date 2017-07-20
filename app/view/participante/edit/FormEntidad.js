Ext.define('sisscsj.view.participante.edit.FormEntidad', {
    extend: 'Ext.form.Panel',
    alias: 'widget.participante.edit.formentidad',
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
                            name: 'fk_id_entidad',
                            fieldLabel: 'Entidad:',
                            displayField: 'nombre_entidad',
                            valueField: 'id_entidad',
                            store: {
                                type: 'entidad.entidad'
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
                            name: 'fecha_vinculacion_beneficiario_entidad',
                            fieldLabel: 'Fecha de Vinculación',
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
                            xtype: 'datefield',
                            name: 'fecha_retiro_beneficiario_entidad',
                            fieldLabel: 'Fecha de Retiro',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_beneficiario_entidad',
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
                            name: 'razon_retiro_beneficiario',
                            fieldLabel: 'Razón de Retiro de Beneficiario'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});