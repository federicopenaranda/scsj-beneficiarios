Ext.define('sisscsj.view.marcologico.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.marcologico.edit.window',
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
                    xtype: 'marcologico.lista'
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