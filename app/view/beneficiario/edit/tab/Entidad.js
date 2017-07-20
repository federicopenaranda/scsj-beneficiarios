Ext.define('sisscsj.view.beneficiario.edit.tab.Entidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.entidad',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listaentidad',
                    title: 'Administración de Entidades de Beneficiario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioEntidad', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});