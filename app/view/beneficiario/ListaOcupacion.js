Ext.define('sisscsj.view.beneficiario.ListaOcupacion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listaocupacion',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.opciones.Ocupacion'
    ],
    minHeight: 250,
    store: 'BeneficiarioOcupacion',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Ocupación',
                        dataIndex: 'fk_id_ocupacion',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: sisscsj.app.globals.globalServerPath + 'Ocupacion',
                                        params: {
                                            start: '',
                                            limit: '',
                                            filter: '[{"property":"id_ocupacion","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('nombre_ocupacion', tmpUE.nombre_ocupacion);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('nombre_ocupacion');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Fecha de Ocupación',
                        dataIndex: 'fecha_beneficiario_ocupacion',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Estado Ocupación',
                        dataIndex: 'estado_beneficiario_ocupacion',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Observaciones Ocupación',
                        dataIndex: 'observacion_beneficiario_ocupacion'
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