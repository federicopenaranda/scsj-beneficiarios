Ext.define('sisscsj.view.familia.edit.tab.InfoFamilia', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.infofamilia',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.edit.forminfofamilia',
                    title: 'Administración de Familia',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.Familia', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});