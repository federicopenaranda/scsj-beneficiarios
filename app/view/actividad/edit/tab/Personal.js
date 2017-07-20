Ext.define('sisscsj.view.actividad.edit.tab.Personal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad.edit.tab.personal',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'actividad.listapersonal',
                    title: 'Personal de la Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.usuario.Usuario', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})