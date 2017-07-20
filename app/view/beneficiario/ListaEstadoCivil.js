Ext.define('sisscsj.view.beneficiario.ListaEstadoCivil', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listaestadocivil',
    store: 'BeneficiarioEstadoCivil',
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
        
        var storeEstadoCivil = Ext.data.StoreManager.lookup('opciones.EstadoCivil');
        storeEstadoCivil.load();

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
                        text: 'Estado Civil',
                        dataIndex: 'fk_id_estado_civil',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_estado_civil',
                            displayField: 'nombre_estado_civil',
                            valueField: 'id_estado_civil',
                            store: {
                                type: 'opciones.estadocivil'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .5,
                        renderer: function (valor){
                            if (valor !== null)
                            {
                                var intIndice = storeEstadoCivil.find('id_estado_civil', valor);
                                var objRegistro = storeEstadoCivil.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_estado_civil');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_beneficiario_estado_civil',
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
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_asignacion_beneficiario_estado_civil',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        editor: {
                            xtype: 'datefield',
                            format: 'Y-m-d',
                            allowBlack: true
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