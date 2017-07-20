Ext.define('sisscsj.view.beneficiario.edit.FormHistoriaSocial', {
    extend: 'Ext.form.Panel',
    alias: 'widget.beneficiario.edit.formhistoriasocial',
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
                            xtype: 'combo',
                            name: 'estado_historia_social',
                            fieldLabel: 'Estado de Historia Social:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Activo', 1],['Inactivo', 0]]
                            }),
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'beneficiario_familia',
                            itemId: 'beneficiario_familia',
                            fieldLabel: 'Copiar de:',
                            valueField: 'id_beneficiario',
                            displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})',
                                        '</tpl>'),
                            tpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '<div class="x-boundlist-item">{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})</div>',
                                        '</tpl>'),
                            store: {
                                type: 'beneficiario.beneficiario'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: true,
                            forceSelection: true,
                            allowBlank: true,
                            typeAhead: true,
                            triggerAction: 'all',
                            minChars : 1,
                            totalProperty : 'total',
                            pageSize : 10,
                            listeners: {
                                beforequery: function( queryPlan, eOpts ) {
                                    var nQuery = [];
                                    var tmpQuery = {
                                        primer_nombre_beneficiario: queryPlan.query,
                                        segundo_nombre_beneficiario: queryPlan.query,
                                        apellido_paterno_beneficiario: queryPlan.query,
                                        apellido_materno_beneficiario: queryPlan.query
                                    };
                                    nQuery.push(tmpQuery); // push this to the array
                                    queryPlan.query = Ext.encode(nQuery);
                                }
                            }
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            itemId: 'historia_social',
                            name: 'historia_social',
                            fieldLabel: 'Historia Social',
                            height: 100
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            itemId: 'dinamica_familiar_historia_social',
                            name: 'dinamica_familiar_historia_social',
                            fieldLabel: 'Dinámica Familiar',
                            height: 100
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            itemId: 'situacion_actual_historia_social',
                            name: 'situacion_actual_historia_social',
                            fieldLabel: 'Situación Actual',
                            height: 100
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});