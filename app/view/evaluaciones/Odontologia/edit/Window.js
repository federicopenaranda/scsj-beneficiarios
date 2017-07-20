Ext.define('sisscsj.view.evaluaciones.Odontologia.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.odontologia.edit.window',
    iconCls: 'icon_user',
    width: 950,
    height: 450,
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
                    xtype: 'evaluaciones.odontologia.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});