Ext.define('sisscsj.view.layout.Center', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.layout.center',
    region: 'center',
    title: 'SISSCSJ',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            
        });
        me.callParent(arguments);
    }
});