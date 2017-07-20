Ext.define('sisscsj.view.monitoreopc.ResultadoMonitoreoPc.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.monitoreopc.resultadomonitoreopc.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.monitoreopc.MonitoreoPc.Lista',
        'sisscsj.view.monitoreopc.ResultadoMonitoreoPc.Lista'
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
                            fieldLabel: 'Característica:',
                            name: 'nombre_caracteristica_monitoreo_pc'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Ámbito:',
                            name: 'nombre_ambito_monitoreo_pc'
                        }                        
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Indicador:',
                            name: 'indicador_ambito_monitoreo_pc'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'resultado_monitoreo_pc',
                            fieldLabel: 'Resultado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Presente', 'presente'],['Reforzar', 'reforzar'],['Ausente', 'ausente']]
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