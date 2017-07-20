Ext.define('sisscsj.view.usuario.edit.tab.Beneficiario', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.edit.tab.beneficiario',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'usuario.beneficiariolista',
                    title: 'Asignación de Beneficiarios a Usuario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.usuario.UsuarioBeneficiario', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})