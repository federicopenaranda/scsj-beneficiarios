Ext.define('sisscsj.view.monitoreoactor.MonitoreoActor.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreoactor.monitoreoactor.edit.tab.evaluacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'monitoreoactor.evaluacionmonitoreoactor.lista',
                    title: 'Administración de Evaluaciones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.monitoreoactor.EvaluacionMonitoreoActor', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});