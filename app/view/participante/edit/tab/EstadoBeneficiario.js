Ext.define('sisscsj.view.participante.edit.tab.EstadoParticipante', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.estadoparticipante',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listaestadoparticipante',
                    title: 'Administración de Estado del Participante',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteEstadoParticipante', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})