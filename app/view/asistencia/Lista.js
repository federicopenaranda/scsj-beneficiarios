Ext.define('sisscsj.view.asistencia.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.asistencia.lista',
    title: 'Administrar Asistencia',
    iconCls: 'icon_user',
    store: 'Asistencia',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {},
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_asistencia',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d',
                        flex: .1
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_asistencia',
                        flex: .9
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
                            disabled: true,
                            //hidden: storePrivilegios.findRecord('nombre','asistencia.edit').getData().valor,
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            disabled: true,
                            iconCls: 'icon_delete',
                            //hidden: storePrivilegios.findRecord('nombre','asistencia.delete').getData().valor,
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