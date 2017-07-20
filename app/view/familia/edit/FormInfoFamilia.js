Ext.define('sisscsj.view.familia.edit.FormInfoFamilia', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.forminfofamilia',
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
                            xtype: 'textfield',
                            name: 'codigo_familia',
                            fieldLabel: 'Código de Familia:',
                            allowBlank: false
                        },
                        {
                            xtype: 'textfield',
                            name: 'codigo_familia_antiguo',
                            fieldLabel: 'Código de Familia (Antigüo):'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'numberfield',
                            minValue: 0,
                            maxValue: 10,
                            name: 'numero_hijos_viven_familia',
                            fieldLabel: 'Número de Hijos en Familia:',
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_familia',
                            fieldLabel: 'Estado de Familia:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreEstadoFamilia,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }              
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});