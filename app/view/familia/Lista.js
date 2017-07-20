Ext.define('sisscsj.view.familia.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.lista',
    title: 'Administrar Familias',
    iconCls: 'icon_familia',
    store: 'Familia',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        var storePrivilegios = Ext.create('Ext.data.Store', {
            fields: ['nombre', 'valor'],
            data : [
                {"nombre":"familia.edit", "valor": false},
                {"nombre":"familia.delete", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true }
            ]
        });
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
                        text: 'Código de Familia',
                        dataIndex: 'codigo_familia'
                    },
                    {
                        text: 'Código de Familia (Ant.)',
                        dataIndex: 'codigo_familia_antiguo'
                    },
                    {
                        text: 'Núm. Hijos',
                        dataIndex: 'numero_hijos_viven_familia'
                    },
                    {
                        text: 'Estado Familia',
                        xtype: 'booleancolumn', 
                        dataIndex: 'estado_familia',
                        trueText: 'Activa',
                        falseText: 'Inactiva'
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
                            text: 'Editar',
                            hidden: storePrivilegios.findRecord('nombre','familia.edit').getData().valor
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar',
                            hidden: storePrivilegios.findRecord('nombre','familia.delete').getData().valor
                        },
                        '->',
                        {
                            xtype:'splitbutton',
                            itemId: 'buscar',
                            iconCls: 'icon_search',
                            text: 'Buscar',
                            menu: [
                                {text: 'Borrar Filtro', itemId: 'clear'}
                            ]
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