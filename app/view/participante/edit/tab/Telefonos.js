Ext.define('sisscsj.view.participante.edit.tab.Telefonos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.telefonos',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listatelefono',
                    title: 'Administración de Teléfonos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteTelefono', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})