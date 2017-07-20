Ext.define('sisscsj.view.evaluaciones.Pedagogia.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.pedagogia.edit.tab.evaluacion',
    layout: 'form',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Evaluación en Apoyo Pedagógico</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_pedagogico',
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
                                    name: 'matematicas_pedagogico',
                                    fieldLabel: 'Matemáticas:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreMatematicas,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'lenguaje_pedagogico',
                                    fieldLabel: 'Lenguaje:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreLenguaje,
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
                                    name: 'desarrollo_habilidades_pedagogico',
                                    fieldLabel: 'Des. de Habilidades:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreDesarrolloHabilidades,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'ciencias_vida_pedagogico',
                                    fieldLabel: 'Ciencias de la Vida:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreCienciasVida,
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
                                    name: 'idiomas_pedagogico',
                                    fieldLabel: 'Idiomas:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreIdiomas,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'tecnologia_pedagogico',
                                    fieldLabel: 'Tecnología:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreTecnologia,
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
                                    name: 'observaciones_pedagogico',
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