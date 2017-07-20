Ext.define('sisscsj.view.familia.DireccionLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.direccionlista',
    store: 'FamiliaDireccion',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.familia.FamiliaDireccion',
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 250,
    initComponent: function() {

        var storeSector = Ext.data.StoreManager.lookup('opciones.Sector');
        storeSector.load();
        
        var me = this;
        
        me.cellEditing = new Ext.grid.plugin.CellEditing({
            clicksToEdit: 2
        });
        
        Ext.applyIf(me, {
            selModel: {
                selType: 'cellmodel'
            },
            plugins: [me.cellEditing],
            columns: {
                defaults: {
                    flex: 1
                },
                items: [
                    {
                        text: 'Sector',
                        dataIndex: 'fk_id_sector',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: sisscsj.app.globals.globalServerPath + 'Sector',
                                        params: {
                                            start: '0',
                                            limit: '100',
                                            filter: '[{"property":"id_sector","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('nombre_sector', tmpUE.nombre_sector);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('nombre_sector');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Dirección',
                        dataIndex: 'direccion_familia_direccion'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_familia_direccion',
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