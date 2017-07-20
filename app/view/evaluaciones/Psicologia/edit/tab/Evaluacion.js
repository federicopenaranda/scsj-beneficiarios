Ext.define('sisscsj.view.evaluaciones.Psicologia.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.psicologia.edit.tab.evaluacion',
    layout: 'form',
    width: 1000,
    height: 350,
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Evaluación en Psicología</strong>',
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
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_tipo_problematica',
                                    fieldLabel: 'Tipo de Problemática:',
                                    displayField: 'nombre_tipo_problematica',
                                    valueField: 'id_tipo_problematica',
                                    store: {
                                        type: 'opciones.tipoproblematica'
                                    },
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
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_sub_area_referencia',
                                    fieldLabel: 'Sub-Área de Ref.:',
                                    //displayField: 'nombre_sub_area',
                                    displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{nombre_sub_area} ({nombre_area_actividad})',
                                        '</tpl>'),
                                    tpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '<div class="x-boundlist-item">{nombre_sub_area} ({nombre_area_actividad})</div>',
                                        '</tpl>'),
                                    valueField: 'id_sub_area',
                                    store: {
                                        type: 'opciones.subareaactividad'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_psicologico',
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
                                    xtype: 'textareafield',
                                    name: 'diagnostico_psicologico',
                                    fieldLabel: 'Diagnóstico',
                                    height: 70
                                },
                                {
                                    xtype: 'textareafield',
                                    name: 'tratamiento_psicologico',
                                    fieldLabel: 'Tratamiento',
                                    height: 70
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_atencion_medica',
                                    fieldLabel: 'Observaciones',
                                    height: 70
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