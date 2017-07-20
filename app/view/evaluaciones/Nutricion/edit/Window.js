Ext.define('sisscsj.view.evaluaciones.Nutricion.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.nutricion.edit.window',
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
                    xtype: 'evaluaciones.nutricion.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});