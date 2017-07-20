Ext.define('sisscsj.view.actividad_proyecto.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.actividad_proyecto.lista',
    title: 'Administrar Actividades de Proyecto',
    iconCls: 'icon_user',
    store: 'ActividadProyecto',
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
                        dataIndex: 'titulo_actividad_proyecto'
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
                        dataIndex: 'fecha_inicio_actividad_proyecto',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Fecha de Fin',
                        dataIndex: 'fecha_fin_actividad_proyecto',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_actividad_proyecto'
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
                        }, '->',
                        {
                            xtype: 'button',
                            itemId: 'asistencia_actividad_proyecto',
                            iconCls: 'icon_tag',
                            text: 'Asistencia'
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