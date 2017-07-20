Ext.define('sisscsj.view.participante.edit.tab.Trabajo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.trabajo',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listatrabajo',
                    title: 'Administración de Trabajos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteTrabajo', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})