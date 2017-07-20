Ext.define('sisscsj.view.monitoreopc.MonitoreoPc.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreopc.monitoreopc.lista',
    title: 'Administrar Ámbitos de Monitoreo',
    iconCls: 'icon_user',
    store: 'MonitoreoPc',
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
                        text: 'Lugar',
                        dataIndex: 'fk_id_lugar_actividad',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_lugar_actividad');
                        }
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_monitoreo_punto_comunitario',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Indicador',
                        dataIndex: 'analisis_monitoreo_punto_comunitario'
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
                            xtype: 'button',
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
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
                        },'->',
                        {
                            xtype: 'button',
                            itemId: 'reporte_monitoreo_pc',
                            iconCls: 'icon_tag',
                            text: 'Reporte'
                        }/*,
                        {
                            xtype: 'button',
                            itemId: 'vista_monitoreo_pc',
                            iconCls: 'icon_search',
                            text: 'Vista Previa'
                        }*/
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