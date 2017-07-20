Ext.define('sisscsj.view.asistenciaactividad.edit.tab.Asistencia', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.asistenciaactividad.edit.tab.asistencia',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'asistenciaactividad.edit.asistenciaform',
                    title: 'Información de la Asistencia',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistenciaactividad.AsistenciaActividad', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});