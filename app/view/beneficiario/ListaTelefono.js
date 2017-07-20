Ext.define('sisscsj.view.beneficiario.ListaTelefono', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listatelefono',
    store: 'BeneficiarioTelefono',
    requires: [
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
            clicksToEdit: 2/*,
            listeners: {
                validateedit: function ( editor, e, eOpts ) {
                    var grid = e.grid,
                                    store = grid.getStore(),
                                    row = store.getAt(e.rowIdx);

                    if (e.field === 'numero_beneficiario_telefono')
                    {
                        console.log(e);
                        if (e.value === '')
                        {
                            //Ext.Msg.alert('Teléfono Vacio', 'Debe llenar un número de teléfono.');
                            //store.removeAt(e.rowIdx);
                            //return false;
                        }
                    }
                }
            }*/
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
                        text: 'Teléfono',
                        dataIndex: 'numero_beneficiario_telefono',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'tipo_telefono',
                        renderer: function (valor) {
                            if ( valor === 'fijo' )
                                return 'Fijo';
                            
                            if ( valor === 'celular' )
                                return 'Celular';
                            
                            return '';
                        },
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreTipoTelefono,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        },
                        flex: .2
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'emergencia_beneficiario_telefono',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Si';
                            
                            if ( valor === 0 )
                                return 'No';
                            
                            return '';
                        },
                        trueText: 'Si',
                        falseText: 'No', 
                        text: 'Emergencia',
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreTelefonoEmergencia,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        },
                        flex: .2
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