Ext.define('sisscsj.view.entidad.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.entidad.lista',
    title: 'Administrar Entidades',
    iconCls: 'icon_user',
    store: 'Entidad',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_entidad'
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'fk_id_tipo_entidad',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_tipo_entidad' )
                        }
                    },
                    {
                        text: 'Fecha de Inicio',
                        dataIndex: 'fecha_inicio_actividades_entidad',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Fecha de Fin',
                        dataIndex: 'fecha_fin_actividades_entidad',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Dirección',
                        dataIndex: 'direccion_entidad'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_entidad'
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
                        }, '->',
                        {
                            xtype: 'button',
                            itemId: 'marcologico',
                            iconCls: 'icon_search',
                            text: 'Marco L&oacute;gico'
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