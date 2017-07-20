Ext.define('sisscsj.view.monitoreoactor.MonitoreoActor.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreoactor.monitoreoactor.lista',
    title: 'Administrar Monitoreos de Actor',
    iconCls: 'icon_user',
    store: 'MonitoreoActor',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 0.2
                },
                items: [
                    {
                        text: 'Tipo de Monitoreo',
                        dataIndex: 'fk_id_tipo_monitoreo_actor',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_tipo_monitoreo_actor');
                        }
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_monitoreo_actor',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Análisis',
                        dataIndex: 'analisis_monitoreo_actor'
                    }
                ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {
                            xtype:'splitbutton',
                            itemId: 'add_monitoreo_actor',
                            text: 'Añadir',
                            iconCls: 'icon_add',
                            menu: [
                                {text: 'Niños y Niñas', itemId: 'add_monitoreo_actor_nino'},
                                {text: 'Adolescentes', itemId: 'add_monitoreo_actor_adolescente'}
                            ]
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        }
                    ]
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore()
                }
            ]
        });
        me.callParent(arguments);
    }
});