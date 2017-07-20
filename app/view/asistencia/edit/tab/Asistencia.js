Ext.define('sisscsj.view.asistencia.edit.tab.Asistencia', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.asistencia.edit.tab.asistencia',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'asistencia.edit.asistenciaform',
                    title: 'Información de la Asistencia',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistencia.Asistencia', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});