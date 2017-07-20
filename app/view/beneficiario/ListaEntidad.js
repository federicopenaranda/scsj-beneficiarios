Ext.define('sisscsj.view.beneficiario.ListaEntidad', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listaentidad',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging',
        'sisscsj.model.entidad.Entidad',
        'sisscsj.store.entidad.Entidad'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeEntidad = Ext.data.StoreManager.lookup('entidad.Entidad');
        storeEntidad.load();

        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {},
                items: [
                    {
                        text: 'Entidad',
                        dataIndex: 'fk_id_entidad',
                        flex: .5,
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: sisscsj.app.globals.globalServerPath + 'Entidad',
                                        params: {
                                            start: '0',
                                            limit: '100',
                                            filter: '[{"property":"id_entidad","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('nombre_entidad', tmpUE.nombre_entidad);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('nombre_entidad');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Fecha Vinculación',
                        dataIndex: 'fecha_vinculacion_beneficiario_entidad',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        flex: .5
                    },
                    {
                        text: 'Fecha Retiro',
                        dataIndex: 'fecha_retiro_beneficiario_entidad',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        flex: .5
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_beneficiario_entidad',
                        renderer: function (valor) {
                            if ( valor === '1' )
                                return 'Activo';
                            
                            if ( valor === '0' )
                                return 'Inactivo';
                            
                            return '';
                        },
                        flex: .5
                    },
                    {
                        text: 'Razón de Retiro',
                        dataIndex: 'razon_retiro_beneficiario'
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