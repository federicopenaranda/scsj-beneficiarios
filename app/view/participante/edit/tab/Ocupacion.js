Ext.define('sisscsj.view.participante.edit.tab.Ocupacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.ocupacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listaocupacion',
                    title: 'Administración de Ocupaciones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteOcupacion', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})