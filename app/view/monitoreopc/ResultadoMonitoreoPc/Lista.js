Ext.define('sisscsj.view.monitoreopc.ResultadoMonitoreoPc.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreopc.resultadomonitoreopc.lista',
    title: 'Administrar Resultados',
    iconCls: 'icon_user',
    store: 'ResultadoMonitoreoPc',
    minHeight: 250,
    autoScroll: true,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 0.2
                },
                items: [
                    {
                        text: 'Caracteristica',
                        dataIndex: 'nombre_caracteristica_monitoreo_pc'
                    },
                    {
                        text: 'Ámbito',
                        dataIndex: 'nombre_ambito_monitoreo_pc'
                    },
                    {
                        text: 'Indicador',
                        dataIndex: 'indicador_ambito_monitoreo_pc'
                    },
                    {
                        text: 'Resultado',
                        dataIndex: 'resultado_monitoreo_pc'
                    }
                ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        /*{
                            xtype: 'button',
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },*/
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
                }
            ]
        });
        me.callParent(arguments);
    }
});