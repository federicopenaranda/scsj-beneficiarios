Ext.define('sisscsj.view.usuario.edit.tab.Entidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.edit.tab.entidad',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'usuario.listaentidad',
                    title: 'Información de Entidad / Usuario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.usuario.UsuarioEntidad', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})