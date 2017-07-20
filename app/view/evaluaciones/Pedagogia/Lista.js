Ext.define('sisscsj.view.evaluaciones.Pedagogia.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.pedagogia.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.pedagogia'
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
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_usuario' )
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
                        text: 'Fecha',
                        dataIndex: 'fecha_pedagogico'
                    },
                    {
                        text: 'Matemáticas',
                        dataIndex: 'matematicas_pedagogico',
                        renderer: function( valor ) {
                            if (valor == 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor == 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor == 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor == 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Lenguaje',
                        dataIndex: 'lenguaje_pedagogico',
                        renderer: function( valor ) {
                            if (valor === 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor === 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor === 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor === 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Des. Habilidades',
                        dataIndex: 'desarrollo_habilidades_pedagogico',
                        renderer: function( valor ) {
                            if (valor === 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor === 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor === 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor === 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Ciencias de la Vida',
                        dataIndex: 'ciencias_vida_pedagogico',
                        renderer: function( valor ) {
                            if (valor === 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor === 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor === 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor === 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Idiomas',
                        dataIndex: 'idiomas_pedagogico',
                        renderer: function( valor ) {
                            if (valor === 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor === 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor === 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor === 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Tecnología',
                        dataIndex: 'tecnologia_pedagogico',
                        renderer: function( valor ) {
                            if (valor === 'desarrollo_aceptable')
                                return 'Desarrollo Aceptable';
                            if (valor === 'desarrollo_optimo')
                                return 'Desarrollo Óptimo';
                            if (valor === 'desarrollo_pleno')
                                return 'Desarrollo Pleno';
                            if (valor === 'en_desarrollo')
                                return 'En Desarrollo';
                        }
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_pedagogico',
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