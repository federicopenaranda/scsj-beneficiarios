Ext.define('sisscsj.view.evaluaciones.NelsonOrtiz.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.nelsonortiz.edit.tab.evaluacion',
    layout: 'form',
    width: 1000,
    height: 550,
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    overflowY: 'auto',
                    title: '<strong>Evaluación Nelson Ortiz</strong>',
                    defaults: {
                        layout: 'hbox'
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
                                    name: 'fecha_nelson_ortiz',
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
                                    xtype: 'combobox',
                                    name: 'motricidad_fina_nelson_ortiz',
                                    fieldLabel: 'Motricidad Fina:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreMotricidadFina,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'personal_social_nelson_ortiz',
                                    fieldLabel: 'Personal y Social:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStorePersonalSocial,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'combobox',
                                    name: 'motricidad_gruesa_nelson_ortiz',
                                    fieldLabel: 'Motricidad Gruesa:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreMotricidadGruesa,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'audicion_lenguaje_nelson_ortiz',
                                    fieldLabel: 'Audición y Lenguaje:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreAudicionLenguaje,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'fieldset',
                    overflowY: 'auto',
                    title: '<strong>Resultado de Evaluación Nelson Ortiz</strong>',
                    defaults: {
                        layout: 'hbox'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'combobox',
                                    name: 'total_nelson_ortiz',
                                    fieldLabel: 'Total:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreTotalNelsonOrtiz,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_nelson_ortiz',
                                    fieldLabel: 'Observaciones',
                                    height: 90,
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