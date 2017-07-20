Ext.define('sisscsj.view.beneficiario.edit.tab.Trabajo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.trabajo',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listatrabajo',
                    title: 'Administración de Trabajos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioTrabajo', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});