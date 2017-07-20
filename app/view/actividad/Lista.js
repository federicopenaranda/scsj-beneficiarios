Ext.define('sisscsj.view.actividad.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.actividad.lista',
    title: 'Administrar Actividades',
    iconCls: 'icon_user',
    store: 'Actividad',
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
                        text: 'Título de Actividad',
                        dataIndex: 'titulo_actividad'
                    },
                    {
                        text: 'Lugar de Actividad',
                        dataIndex: 'fk_id_lugar_actividad',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_lugar_actividad' );
                        }
                    },
                    {
                        text: 'Fecha de Inicio',
                        dataIndex: 'fecha_inicio_actividad',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Fecha de Fin',
                        dataIndex: 'fecha_fin_actividad',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_actividad'
                    },
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' );
                        }
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
                        },
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'asistencia',
                            iconCls: 'icon_category',
                            text: 'Asistencia de Actividad'
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