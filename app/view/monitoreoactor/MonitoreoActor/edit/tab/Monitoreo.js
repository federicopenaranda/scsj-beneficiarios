Ext.define('sisscsj.view.monitoreoactor.MonitoreoActor.edit.tab.Monitoreo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreoactor.monitoreoactor.edit.tab.monitoreo',
    layout: 'form',
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
                            name: 'fecha_monitoreo_actor',
                            fieldLabel: 'Fecha',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false
                        }                        
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'analisis_monitoreo_actor',
                            fieldLabel: 'Análisis de Monitoreo',
                            height: 200,
                            allowBlank: true
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});