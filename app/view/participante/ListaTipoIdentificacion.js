Ext.define('sisscsj.view.participante.ListaTipoIdentificacion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.participante.listatipoidentificacion',
    store: 'ParticipanteTipoIdentificacion',
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

        var storeTipoIdentificacion = Ext.data.StoreManager.lookup('opciones.TipoIdentificacion');
        storeTipoIdentificacion.load();        
        
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
                        text: 'Tipo de Identificación',
                        dataIndex: 'fk_id_tipo_identificacion',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoIdentificacion.find('id_tipo_identificacion', valor);
                                var objRegistro = storeTipoIdentificacion.getAt(intIndice);
                                var txtNombreCampo = objRegistro.get('nombre_tipo_identificacion');
                                return (txtNombreCampo != "") ? txtNombreCampo : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        },
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_identificacion',
                            displayField: 'nombre_tipo_identificacion',
                            valueField: 'id_tipo_identificacion',
                            store: {
                                type: 'opciones.tipoidentificacion'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .5
                    },
                    {
                        text: 'Número',
                        dataIndex: 'numero_tipo_identificacion',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .5
                    },
                    {
                        text: 'Primario?',
                        dataIndex: 'primario_tipo_identificacion',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Si';
                            
                            if ( valor === 0 )
                                return 'No';
                            
                            return '';
                        },
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStorePrioridad,
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