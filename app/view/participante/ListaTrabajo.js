Ext.define('sisscsj.view.participante.ListaTrabajo', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.participante.listatrabajo',
    requires: [
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Monto',
                        dataIndex: 'monto_ingreso_beneficiario_trabajo',
                        renderer: function (valor) {
                            return 'Bs.' + valor;
                        }
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'tipo_trabajo_beneficiario_trabajo'
                    },
                    {
                        text: 'Estado Trabajo',
                        dataIndex: 'estado_beneficiario_trabajo',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Descripción Trabajo',
                        dataIndex: 'descripcion_beneficiario_trabajo'
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
                }
            ]
        });
        me.callParent(arguments);
    }
});