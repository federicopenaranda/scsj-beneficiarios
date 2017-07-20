Ext.define('sisscsj.view.beneficiario.edit.tab.UnidadEducativa', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.unidadeducativa',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listaunidadeducativa',
                    title: 'Administración de Unidad Educativa',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioUnidadEducativa', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});