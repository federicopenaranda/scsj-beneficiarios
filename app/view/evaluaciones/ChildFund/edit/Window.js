Ext.define('sisscsj.view.evaluaciones.ChildFund.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.childfund.edit.window',
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
                    xtype: 'evaluaciones.childfund.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});