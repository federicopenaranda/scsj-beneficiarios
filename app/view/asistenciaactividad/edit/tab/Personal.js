Ext.define('sisscsj.view.asistenciaactividad.edit.tab.Personal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.asistenciaactividad.edit.tab.personal',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'asistenciaactividad.personallista',
                    title: 'Personal de la Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistenciaactividad.AsistenciaPersonal', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});