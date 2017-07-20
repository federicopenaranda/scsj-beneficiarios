Ext.define('sisscsj.view.resultado.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.resultado.lista',
    store: {
        type: 'resultado.resultado'
    },
    requires: [
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 310,
    //xtype: 'cell-editing',
    initComponent: function() {
        var me = this;
        
        me.cellEditing = new Ext.grid.plugin.CellEditing({
            clicksToEdit: 2
        });
        
        Ext.applyIf(me, {
            selModel: {
                selType: 'cellmodel'
            },
            plugins: [me.cellEditing],
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_resultado'
                    },
                    {
                        text: 'Metas',
                        dataIndex: 'metas_resultado'
                    },
                    {
                        text: 'Indicadores',
                        dataIndex: 'indicadores_resultado'
                    },
                    {
                        text: 'Medios de Ver.',
                        dataIndex: 'medios_verificacion_resultado'
                    },
                    {
                        text: 'Supuestos',
                        dataIndex: 'supuestos_resultado'
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
                            itemId: 'resultadoevaluacion',
                            iconCls: 'icon_search',
                            text: 'Evaluacion'
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