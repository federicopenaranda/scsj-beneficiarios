Ext.define('sisscsj.view.evaluaciones.Computacion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.computacion.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.computacion'
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
                        text: 'Tipo de Evaluación',
                        dataIndex: 'tipo_eval_computacion'
                    },
                    {
                        text: 'Fecha',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d',
                        dataIndex: 'fecha_eval_computacion'
                    },
                    {
                        text: 'Evaluación',
                        dataIndex: 'evaluacion_computacion',
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
                        text: 'Observaciones',
                        dataIndex: 'observaciones_eval_computacion',
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