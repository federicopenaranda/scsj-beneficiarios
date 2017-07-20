Ext.define('sisscsj.view.actividad.edit.tab.Beneficiarios', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad.edit.tab.beneficiarios',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'actividad.listabeneficiarios',
                    title: 'Participantes de la Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.actividad.ActividadBeneficiario', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});