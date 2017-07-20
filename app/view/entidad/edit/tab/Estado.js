Ext.define('sisscsj.view.entidad.edit.tab.Estado', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.entidad.edit.tab.estado',
    bodyPadding: 0,
    margin: 0,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'entidad.listaentidadestadoentidad',
                    title: 'Administración del Estado de Entidades',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.entidad.EntidadEstadoEntidad', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
})