Ext.define('sisscsj.view.opciones.CompetenciaMonitoreoActor.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.competenciamonitoreoactor.lista',
    title: 'Administrar Competencias de Monitoreo',
    iconCls: 'icon_user',
    store: 'CompetenciaMonitoreoActor',
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
                        text: 'Tipo de Monitoreo',
                        dataIndex: 'fk_id_tipo_monitoreo_actor',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_tipo_monitoreo_actor');
                        }
                    },
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_competencia_monitoreo_actor'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_competencia_monitoreo_actor'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_competencia_monitoreo_actor',
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