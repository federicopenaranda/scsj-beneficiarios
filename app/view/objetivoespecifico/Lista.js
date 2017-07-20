Ext.define('sisscsj.view.objetivoespecifico.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.objetivoespecifico.lista',
    store: {
        type: 'objetivoespecifico.objetivoespecifico'
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
                        dataIndex: 'descripcion_objetivo_especifico'
                    },
                    {
                        text: 'Metas',
                        dataIndex: 'metas_objetivo_especifico'
                    },
                    {
                        text: 'Indicadores',
                        dataIndex: 'indicadores_objetivo_especifico'
                    },
                    {
                        text: 'Medios de Ver.',
                        dataIndex: 'medios_verificacion_objetivo_especifico'
                    },
                    {
                        text: 'Supuestos',
                        dataIndex: 'supuestos_objetivo_especifico'
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
                            itemId: 'resultado',
                            iconCls: 'icon_search',
                            text: 'Resultado'
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