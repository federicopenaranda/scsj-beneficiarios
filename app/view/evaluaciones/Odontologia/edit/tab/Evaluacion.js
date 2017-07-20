Ext.define('sisscsj.view.evaluaciones.Odontologia.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.odontologia.edit.tab.evaluacion',
    layout: 'form',
    width: 1000,
    height: 450,
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Evaluación Odontológica</strong>',
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
                                    name: 'fecha_odontologia',
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
                                    xtype: 'numberfield',
                                    name: 'cpitn_odontologia',
                                    fieldLabel: 'CPITN:',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'higiene_odontologia',
                                    fieldLabel: 'Higiene:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreHigieneOdontologica,
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
                                    name: 'indice_may_c_odontologia',
                                    fieldLabel: 'Índice "C":',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_may_p_odontologia',
                                    fieldLabel: 'Índice "P":',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_may_d_odontologia',
                                    fieldLabel: 'Índice "D":',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_may_o_odontologia',
                                    fieldLabel: 'Índice "O":',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_min_c_odontologia',
                                    fieldLabel: 'Índice "c":',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_min_e_odontologia',
                                    fieldLabel: 'Índice "e":',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'indice_min_o_odontologia',
                                    fieldLabel: 'Índice "o":',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_odontologia',
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
});