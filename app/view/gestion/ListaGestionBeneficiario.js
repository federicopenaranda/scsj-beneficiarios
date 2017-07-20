Ext.define('sisscsj.view.gestion.GestionBeneficiarioLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.gestion.gestionbeneficiariolista',
    minHeight: 450,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {},
                items: [
                    {
                        xtype: 'actioncolumn',
                        width: '50',
                        items: [
                            {
                                icon: './resources/images/icon/delete.png',
                                tooltip: 'Desinscribir',
                                handler: function(grid, rowIndex, colIndex) {
                                    me.fireEvent('itemdeletebuttonclick', grid, rowIndex, colIndex);
                                }
                            }
                        ]
                    },
                    {
                        text: 'Código',
                        dataIndex: 'codigo_beneficiario',
                        renderer: function ( value, metaData, record, rowIndex, colIndex, store, view ){
                            return record.get( 'codigo_beneficiario' );
                        },
                        flex: 1
                    },
                    {
                        text: 'Nombre',
                        dataIndex: 'primer_nombre_beneficiario',
                        flex: 1
                    },
                    {
                        text: 'Ap. Paterno',
                        dataIndex: 'apellido_paterno_beneficiario',
                        flex: 1
                    },
                    {
                        text: 'Ap. Materno',
                        dataIndex: 'apellido_materno_beneficiario',
                        flex: 1
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
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'importagestionanterior',
                            iconCls: 'icon_detail',
                            text: 'Importar Gestión Anterior'
                        },
                        {
                            xtype: 'button',
                            itemId: 'exportar',
                            iconCls: 'icon_detail',
                            text: 'Exportar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'buscar',
                            iconCls: 'icon_search',
                            text: 'Buscar'
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