Ext.define('sisscsj.view.resultadoevaluacion.edit.tab.Resultado', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.resultadoevaluacion.edit.tab.resultado',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Resultado</strong>',
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
                                    name: 'tipo_resultado_evaluacion',
                                    fieldLabel: 'Tipo de Evaluaci&oacute;n:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: new Ext.data.SimpleStore({
                                        fields: ['nombre', 'valor'],
                                        data : [['Evaluación Trimestral', 'trimestral'],['Evaluación Anual', 'anual']]
                                    }),
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
                                    name: 'informacion_cualitativa_resultado_evaluacion',
                                    fieldLabel: 'Informaci&oacute;n Cualitativa',
                                    height: 80
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'accion_seguimiento_resultado_evaluacion',
                                    fieldLabel: 'Acci&oacute;n de Seguimiento',
                                    height: 80
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'evaluacion_resultado_evaluacion',
                                    fieldLabel: 'Evaluaci&oacute;n',
                                    height: 80
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