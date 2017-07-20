Ext.define('sisscsj.view.asistencia.edit.tab.Beneficiarios', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.asistencia.edit.tab.beneficiarios',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'asistencia.beneficiarioslista',
                    title: 'Beneficiarios',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistencia.AsistenciaBeneficiario', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});