Ext.define('sisscsj.view.evaluaciones.Biblioteca.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.biblioteca.edit.window',
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
                    xtype: 'evaluaciones.biblioteca.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});