Ext.define('sisscsj.view.familia.edit.tab.TipoCasa', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.tipocasa',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'familia.listatipocasa',
                    title: 'Tipo de Casa',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.FamiliaTipoCasa', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});