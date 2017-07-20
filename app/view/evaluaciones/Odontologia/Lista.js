Ext.define('sisscsj.view.evaluaciones.Odontologia.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.odontologia.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.odontologia'
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
                        text: 'Beneficiario',
                        dataIndex: 'fk_id_beneficiario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'codigo_beneficiario' )
                        }
                    },
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        hidden: true,
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' )
                        }
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_odontologia'
                    },
                    {
                        text: 'CPITN',
                        dataIndex: 'cpitn_odontologia'
                    },
                    {
                        text: 'Higiene',
                        dataIndex: 'higiene_odontologia'
                    },
                    {
                        text: 'Índice "C"',
                        dataIndex: 'indice_may_c_odontologia'
                    },
                    {
                        text: 'Índice "P"',
                        dataIndex: 'indice_may_p_odontologia'
                    },
                    {
                        text: 'Índice "D"',
                        dataIndex: 'indice_may_d_odontologia'
                    },
                    {
                        text: 'Índice "O"',
                        dataIndex: 'indice_may_o_odontologia'
                    },
                    {
                        text: 'Índice "c"',
                        dataIndex: 'indice_min_c_odontologia'
                    },
                    {
                        text: 'Índice "e"',
                        dataIndex: 'indice_min_e_odontologia'
                    },
                    {
                        text: 'Índice "o"',
                        dataIndex: 'indice_min_o_odontologia'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_odontologia',
                        hidden: true
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