Ext.define('sisscsj.view.asistenciaactividad.edit.tab.Beneficiarios', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.asistenciaactividad.edit.tab.beneficiarios',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'asistenciaactividad.beneficiarioslista',
                    title: 'Participantes de la Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistenciaactividad.AsistenciaBeneficiario', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});