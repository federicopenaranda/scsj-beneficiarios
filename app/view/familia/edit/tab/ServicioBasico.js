Ext.define('sisscsj.view.familia.edit.tab.ServicioBasico', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.serviciobasico',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.listaserviciobasico',
                    title: 'Servicios Básicos de Familia',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.FamiliaServicioBasico', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});