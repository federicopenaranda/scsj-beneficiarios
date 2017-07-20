Ext.define('sisscsj.view.resultadoevaluacion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.resultadoevaluacion.lista',
    store: {
        type: 'resultadoevaluacion.resultadoevaluacion'
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
                items: [
                    {
                        text: 'Tipo de Resultado',
                        dataIndex: 'tipo_resultado_evaluacion'
                    },
                    {
                        text: 'Info. Cualitativa',
                        dataIndex: 'informacion_cualitativa_resultado_evaluacion'
                    },
                    {
                        text: 'Acciones de Seg.',
                        dataIndex: 'accion_seguimiento_resultado_evaluacion'
                    },
                    {
                        text: 'Eval. de Resultado',
                        dataIndex: 'evaluacion_resultado_evaluacion'
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