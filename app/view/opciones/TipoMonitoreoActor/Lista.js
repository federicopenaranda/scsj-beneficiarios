Ext.define('sisscsj.view.opciones.TipoMonitoreoActor.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.tipomonitoreoactor.lista',
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
                defaults: {
                    flex: .2
                },
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_tipo_monitoreo_actor',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_tipo_monitoreo_actor',
                        editor: {
                            xtype: 'combo',
                            name: 'estado_tipo_monitoreo_actor',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data : [['Activo', 1],['Inactivo', 0]]
                            }),
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_tipo_monitoreo_actor',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: true
                        }
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