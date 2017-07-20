Ext.define('sisscsj.view.evaluaciones.Nutricion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.nutricion.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.nutricion'
    },
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
                        text: 'Tipo de Consulta',
                        dataIndex: 'fk_id_tipo_consulta',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_tipo_consulta' )
                        }
                    },
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' )
                        }
                    },
                    {
                        text: 'Peso',
                        dataIndex: 'peso_nutricion'
                    },
                    {
                        text: 'Talla',
                        dataIndex: 'talla_nutricion'
                    },
                    {
                        text: 'Peso/Talla',
                        dataIndex: 'peso_talla_nutricion'
                    },
                    {
                        text: 'Talla/Edad',
                        dataIndex: 'talla_edad_nutricion'
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_nutricion'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_nutricion'
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