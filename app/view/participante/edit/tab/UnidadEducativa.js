Ext.define('sisscsj.view.participante.edit.tab.UnidadEducativa', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.unidadeducativa',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listaunidadeducativa',
                    title: 'Administración de Unidad Educativa',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteUnidadEducativa', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})