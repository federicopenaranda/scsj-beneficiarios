Ext.define('sisscsj.view.evaluaciones.NelsonOrtiz.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.nelsonortiz.edit.window',
    iconCls: 'icon_user',
    width: 900,
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
                    xtype: 'evaluaciones.nelsonortiz.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});