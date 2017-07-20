Ext.define('sisscsj.view.asistenciaactividad.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.asistenciaactividad.lista',
    title: 'Administrar Asistencia',
    iconCls: 'icon_user',
    store: 'AsistenciaActividad',
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
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        width: 250
                    },
                    {
                        text: 'Actividad',
                        dataIndex: 'fk_id_actividad',
                        width: 250  
                    },
                    {
                        text: 'Fecha Nac.',
                        dataIndex: 'fecha_asistencia',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d',
                        width: 100
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_asistencia',
                        width: 100
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