Ext.define('sisscsj.view.layout.North', {
    extend: 'Ext.panel.Panel',
    id: 'view.layout.North',
    // alias allows us to define a custom xtype for this component, which we can use as a shortcut
    // for adding this component as a child of another
    alias: 'widget.layout.north',
    region: 'north',
    bodyPadding: 5,
    html: '<table><tr><td><img id="logo" src="./resources/images/logo2.png" /></td><td><h2>SISSCSJ - Sistema de Sociedad Católica San José</h2></td></tr></table>',
    cls: 'header',
    items: [
        {
            xtype: 'FileDownloader',
            id: 'FileDownloader',
            itemId: 'FileDownloader'
        }
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            
        });
        me.callParent(arguments);
    }
});