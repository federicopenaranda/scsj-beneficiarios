Ext.define('sisscsj.view.beneficiario.edit.tab.EstadoBeneficiario', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.estadobeneficiario',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listaestadobeneficiario',
                    title: 'Administración de Estado del Beneficiario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioEstadoBeneficiario', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});