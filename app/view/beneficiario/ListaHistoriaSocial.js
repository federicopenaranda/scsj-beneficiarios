Ext.define('sisscsj.view.beneficiario.ListaHistoriaSocial', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listahistoriasocial',
    requires: [
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: 1
                },
                items: [
                    {
                        text: 'Historia Social',
                        dataIndex: 'historia_social'
                    },
                    {
                        text: 'Dinámica Familiar',
                        dataIndex: 'dinamica_familiar_historia_social'
                    },
                    {
                        text: 'Situación Actual',
                        dataIndex: 'situacion_actual_historia_social'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_historia_social',
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
                }
            ]
        });
        me.callParent(arguments);
    }
});