Ext.define('sisscsj.view.evaluaciones.Pedagogia.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.pedagogia.edit.window',
    iconCls: 'icon_user',
    width: 950,
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
                    xtype: 'evaluaciones.pedagogia.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});