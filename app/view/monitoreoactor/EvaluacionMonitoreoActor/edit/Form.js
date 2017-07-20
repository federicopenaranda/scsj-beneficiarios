Ext.define('sisscsj.view.monitoreoactor.EvaluacionMonitoreoActor.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.monitoreoactor.evaluacionmonitoreoactor.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.monitoreoactor.MonitoreoActor.Lista',
        'sisscsj.view.monitoreoactor.EvaluacionMonitoreoActor.Lista'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
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
                            xtype: 'displayfield',
                            fieldLabel: 'Criterio:',
                            name: 'fk_id_criterio_monitoreo_actor'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Participante:',
                            name: 'fk_id_beneficiario'
                        }                        
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'evaluacion_monitoreo_actor',
                            fieldLabel: 'Evaluación:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Activo', 1],['Inactivo', 0]]
                            }),
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});