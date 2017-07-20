Ext.define('sisscsj.view.evaluaciones.Nutricion.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.nutricion.edit.tab.evaluacion',
    layout: 'form',
    width: 1200,
    height: 450,
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Evaluación de Nutrición</strong>',
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
                                    name: 'fk_id_tipo_consulta',
                                    fieldLabel: 'Tipo de Consulta:',
                                    displayField: 'nombre_tipo_consulta',
                                    valueField: 'id_tipo_consulta',
                                    store: {
                                        type: 'opciones.tipoconsulta'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_nutricion',
                                    fieldLabel: 'Fecha de Atención',
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
                                    name: 'peso_talla_nutricion',
                                    fieldLabel: 'Peso/Talla:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStorePesoTalla,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'combo',
                                    name: 'talla_edad_nutricion',
                                    fieldLabel: 'Talla/Edad:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreTallaEdad,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'numberfield',
                                    name: 'peso_nutricion',
                                    fieldLabel: 'Peso:',
                                    minValue: 0,
                                    allowDecimals: true,
                                    decimalSeparator: '.'
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'talla_nutricion',
                                    fieldLabel: 'Talla:',
                                    minValue: 0,
                                    allowDecimals: true,
                                    decimalSeparator: '.'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_nutricion',
                                    fieldLabel: 'Observaciones',
                                    height: 100,
                                    allowBlank: true
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
})