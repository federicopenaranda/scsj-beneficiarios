Ext.define('sisscsj.view.familia.edit.FormDireccion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.formdireccion',
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
                allowBlank: true,
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_sector',
                            fieldLabel: 'Sector:',
                            displayField: 'nombre_sector',
                            valueField: 'id_sector',
                            store: {
                                type: 'opciones.sector'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: true,
                            forceSelection: true,
                            allowBlank: false,
                            typeAhead: true,
                            triggerAction: 'all',
                            minChars : 1,
                            totalProperty : 'total',
                            pageSize : 10,
                            listeners: {
                                beforequery: function( queryPlan, eOpts ) {
                                    var nQuery = [];
                                    var tmpQuery = {
                                        nombre_sector: queryPlan.query
                                    };
                                    nQuery.push(tmpQuery); // push this to the array
                                    queryPlan.query = Ext.encode(nQuery);
                                }
                            }
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_familia_direccion',
                            fieldLabel: 'Estado Dirección:',
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
                            name: 'direccion_familia_direccion',
                            fieldLabel: 'Dirección',
                            allowBlank: false
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});