Ext.define('sisscsj.view.objetivoespecifico.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.objetivoespecifico.edit.window',
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
                    xtype: 'objetivoespecifico.lista'
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