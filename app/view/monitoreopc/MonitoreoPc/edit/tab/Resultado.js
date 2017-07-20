Ext.define('sisscsj.view.monitoreopc.MonitoreoPc.edit.tab.Resultado', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreopc.ponitoreopc.edit.tab.resultado',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'monitoreopc.resultadomonitoreopc.lista',
                    title: 'Administración de Resultados',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.monitoreopc.ResultadoMonitoreoPc', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});