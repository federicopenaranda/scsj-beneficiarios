/**
 * Main panel for displaying images for {@link CarTracker.model.Car} records
 */
Ext.define('sisscsj.view.participante.edit.tab.EstadoCivil', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.estadocivil',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'participante.listaestadocivil',
                    title: 'Administración de Estado Civil',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.ParticipanteEstadoCivil', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})