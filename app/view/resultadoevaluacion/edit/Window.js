Ext.define('sisscsj.view.resultadoevaluacion.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.resultadoevaluacion.edit.window',
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
                    xtype: 'resultadoevaluacion.lista'
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