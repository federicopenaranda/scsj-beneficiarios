Ext.define('sisscsj.view.opciones.ParametrosGenerales.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.parametrosgenerales.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            plugins: [
                {
                    ptype: 'rowediting',
                    clicksToEdit: 2,
                    saveBtnText: 'Guardar',
                    cancelBtnText: 'Cancelar',
                    errorsText: 'Errores',
                    dirtyText: 'Es necesario guardar o cancelar los cambios.'
                }
            ],
            columns: {
                defaults: {},
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_parametro',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Valor',
                        dataIndex: 'valor_parametro',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Configuración',
                        dataIndex: 'configuracion_parametro',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_parametro',
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreEstado,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        },
                        flex: .2
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
