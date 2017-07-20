Ext.define('sisscsj.view.evaluaciones.Enfermeria.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.enfermeria.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.enfermeria'
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
                            return record.get( 'nombre_tipo_consulta' );
                        }
                    },
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' );
                        }
                    },
                    {
                        text: 'Vacuna',
                        dataIndex: 'fk_id_vacuna',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_vacuna' );
                        }
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_enfermeria',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_enfermeria'
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