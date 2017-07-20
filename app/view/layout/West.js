Ext.define('sisscsj.view.layout.West', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.layout.west',
    collapsible: true,
    requires: [
        'sisscsj.view.layout.Menu'
    ],
    region: 'west',
    title: 'Menú',
    split: true,
    bodyPadding: 5,
    //minWidth: 175,
    width: 175,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
             items: [
                {
                    xtype: 'layout.menu'
                }
             ]
        });
        me.callParent(arguments);
    }
});