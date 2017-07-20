Ext.define('sisscsj.view.participante.edit.tab.TipoIdentificacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.tipoidentificacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listatipoidentificacion',
                    title: 'Administración de Identificación',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteTipoIdentificacion', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})