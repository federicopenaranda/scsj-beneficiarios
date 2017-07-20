Ext.define('sisscsj.view.familia.edit.tab.EventoVital', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.eventovital',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.eventovitallista',
                    title: 'Eventos Vitales de Familia',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.FamiliaEventoVital', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});