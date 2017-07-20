Ext.define('sisscsj.view.actividad_proyecto.actividad_tipo_participante.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.actividad_proyecto.actividad_tipo_participante.edit.window',
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
                    xtype: 'actividad_proyecto.actividad_tipo_participante.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});