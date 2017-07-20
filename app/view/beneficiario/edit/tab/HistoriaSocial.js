Ext.define('sisscsj.view.beneficiario.edit.tab.HistoriaSocial', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.historiasocial',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listahistoriasocial',
                    title: 'Administración de Historia Social',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioHistoriaSocial', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});