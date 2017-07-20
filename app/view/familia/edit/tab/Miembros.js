Ext.define('sisscsj.view.familia.edit.tab.Miembros', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.miembros',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.miembroslista',
                    title: 'Miembros de Familia',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.FamiliaMiembros', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});