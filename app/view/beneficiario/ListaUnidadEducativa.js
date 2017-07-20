Ext.define('sisscsj.view.beneficiario.ListaUnidadEducativa', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listaunidadeducativa',
    store: 'BeneficiarioUnidadEducativa',
    requires: [
        'Ext.toolbar.Paging',
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 250,
    initComponent: function() {
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
                defaults: {},
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Unidad Educativa',
                        dataIndex: 'fk_id_unidad_educativa',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_unidad_educativa',
                            displayField: 'nombre_unidad_educativa',
                            valueField: 'id_unidad_educativa',
                            store: {
                                type: 'opciones.unidadeducativa'
                            },
                            editable: true,
                            forceSelection: true,
                            allowBlank: false,
                            typeAhead: true,
                            triggerAction: 'all',
                            minChars : 1,
                            totalProperty : 'total',
                            pageSize : 10,
                            listeners: {
                                beforequery: function( queryPlan, eOpts ) {
                                    var nQuery = [];
                                    var tmpQuery = {
                                        nombre_unidad_educativa: queryPlan.query
                                    };
                                    nQuery.push(tmpQuery); // push this to the array
                                    queryPlan.query = Ext.encode(nQuery);
                                }
                            }
                        },
                        flex: .5,
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: sisscsj.app.globals.globalServerPath + 'UnidadEducativa',
                                        params: {
                                            start: '0',
                                            limit: '1',
                                            filter: '[{"property":"id_unidad_educativa","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('nombre_unidad_educativa', tmpUE.nombre_unidad_educativa);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('nombre_unidad_educativa');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_beneficiario_unidad_educativa',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        },
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreEstado,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        },
                        flex: .5
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