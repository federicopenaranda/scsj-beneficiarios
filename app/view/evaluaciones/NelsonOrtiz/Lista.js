Ext.define('sisscsj.view.evaluaciones.NelsonOrtiz.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.nelsonortiz.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.nelsonortiz'
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
                        text: 'Fecha',
                        dataIndex: 'fecha_nelson_ortiz'
                    },
                    {
                        text: 'Mot. Gruesa',
                        dataIndex: 'motricidad_gruesa_nelson_ortiz'
                    },
                    {
                        text: 'Aud. y Leng.',
                        dataIndex: 'audicion_lenguaje_nelson_ortiz'
                    },
                    {
                        text: 'Mot. Fina',
                        dataIndex: 'motricidad_fina_nelson_ortiz'
                    },
                    {
                        text: 'Personal Social',
                        dataIndex: 'personal_social_nelson_ortiz'
                    },
                    {
                        text: 'Total',
                        dataIndex: 'total_nelson_ortiz'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_nelson_ortiz',
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