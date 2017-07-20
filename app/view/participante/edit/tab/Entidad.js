Ext.define('sisscsj.view.participante.edit.tab.Entidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.entidad',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listaentidad',
                    title: 'Administración de Entidades de Participante',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteEntidad', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})