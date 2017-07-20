Ext.define('sisscsj.view.opciones.AmbitoMonitoreoPc.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.ambitomonitoreopc.lista',
    title: 'Administrar Ámbitos de Monitoreo',
    iconCls: 'icon_user',
    store: 'AmbitoMonitoreoPc',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 0.2
                },
                items: [
                    {
                        text: 'Característica',
                        dataIndex: 'fk_id_caracteristica_monitoreo_pc',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_caracteristica_monitoreo_pc');
                        }
                    },
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_ambito_monitoreo_pc'
                    },
                    {
                        text: 'Indicador',
                        dataIndex: 'indicador_ambito_monitoreo_pc'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_ambito_monitoreo_pc',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
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