Ext.define('sisscsj.view.opciones.UnidadEducativa.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.unidadeducativa.lista',
    title: 'Administrar Unidades Educativas',
    iconCls: 'icon_user',
    store: 'UnidadEducativa',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {},
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_unidad_educativa',
                        width: 200
                    },
                    {
                        text: 'Teléfono',
                        dataIndex: 'telefono_unidad_educativa',
                        width: 150
                    },
                    {
                        text: 'Dirección',
                        dataIndex: 'direccion_unidad_educativa',
                        width: 450
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