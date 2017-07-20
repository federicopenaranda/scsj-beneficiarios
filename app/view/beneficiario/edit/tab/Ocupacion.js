Ext.define('sisscsj.view.beneficiario.edit.tab.Ocupacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.ocupacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listaocupacion',
                    title: 'Administración de Ocupaciones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioOcupacion', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});