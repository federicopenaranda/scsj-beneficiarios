Ext.define('sisscsj.view.evaluaciones.Enfermeria.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.enfermeria.edit.tab.evaluacion',
    layout: 'form',
    width: 1000,
    height: 350,
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Evaluación de Enfermería</strong>',
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
                                    name: 'fk_id_vacuna',
                                    fieldLabel: 'Vacuna:',
                                    displayField: 'nombre_vacuna',
                                    valueField: 'id_vacuna',
                                    store: {
                                        type: 'opciones.vacuna'
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
                                    xtype: 'datefield',
                                    name: 'fecha_enfermeria',
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
                                    name: 'observaciones_enfermeria',
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