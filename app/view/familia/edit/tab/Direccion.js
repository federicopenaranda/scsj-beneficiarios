Ext.define('sisscsj.view.familia.edit.tab.Direccion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.direccion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.direccionlista',
                    title: 'Dirección de Familia',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.FamiliaDireccion', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});