Ext.define('sisscsj.view.objetivogeneral.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.objetivogeneral.edit.window',
    iconCls: 'icon_user',
    width: 800,
    height: 400,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    // include form
                    xtype: 'objetivogeneral.lista'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer'
                }
            ]
        });
        me.callParent(arguments);
    }
});