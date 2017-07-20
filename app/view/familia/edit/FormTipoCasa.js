Ext.define('sisscsj.view.familia.edit.FormTipoCasa', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.formtipocasa',
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
                            name: 'fk_id_tipo_cocina',
                            fieldLabel: 'Tipo de Cocina:',
                            displayField: 'nombre_tipo_cocina',
                            valueField: 'id_tipo_cocina',
                            store: {
                                type: 'opciones.tipococina'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            allowBlank: false,
                            forceSelection: true
                        },
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_casa',
                            fieldLabel: 'Tipo de Casa:',
                            displayField: 'nombre_tipo_casa',
                            valueField: 'id_tipo_casa',
                            store: {
                                type: 'opciones.tipocasa'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            allowBlank: false,
                            forceSelection: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'estado_familia_tipo_casa',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreEstado,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            allowBlank: false,
                            forceSelection: true
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_registro_familia_tipo_casa',
                            fieldLabel: 'Fecha de Registro',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'cuartos_multiuso_familia_tipo_casa',
                            fieldLabel: 'Cuartos Multiuso:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreCuartosMultiuso,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true
                        },
                        {
                            xtype: 'numberfield',
                            minValue: 1,
                            maxValue: 20,
                            fieldLabel: 'Ambientes de la Casa:',
                            name: 'ambientes_familia_tipo_casa',
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'observacion_familia_tipo_casa',
                            fieldLabel: 'Observaciones',
                            height: 80
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});