Ext.define('sisscsj.view.beneficiario.edit.tab.TipoIdentificacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.tipoidentificacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listatipoidentificacion',
                    title: 'Administración de Identificación',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioTipoIdentificacion', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});