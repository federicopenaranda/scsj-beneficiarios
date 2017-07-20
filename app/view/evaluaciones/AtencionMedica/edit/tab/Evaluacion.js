Ext.define('sisscsj.view.evaluaciones.AtencionMedica.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.atencionmedica.edit.tab.evaluacion',
    layout: 'form',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información Organizacional de Beneficiario</strong>',
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
                                    name: 'fecha_atencion_medica',
                                    fieldLabel: 'Fecha de Atención',
                                    format: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_diagnostico',
                                    fieldLabel: 'Diagnóstico:',
                                    displayField: 'nombre_diagnostico',
                                    valueField: 'id_diagnostico',
                                    store: {
                                        type: 'opciones.diagnostico'
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
                                    xtype: 'textareafield',
                                    name: 'observaciones_atencion_medica',
                                    fieldLabel: 'Observaciones',
                                    height: 100
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