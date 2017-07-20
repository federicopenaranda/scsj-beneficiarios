Ext.define('sisscsj.view.entidad.ListaEntidadEstadoEntidad', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.entidad.listaentidadestadoentidad',
    store: 'EntidadEstadoEntidad',
    requires: [
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 310,
    xtype: 'cell-editing',
    initComponent: function() {

        var storeEstadoEntidad = Ext.data.StoreManager.lookup('opciones.EstadoEntidad');
        storeEstadoEntidad.load();

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
                        text: 'Estado (Entidad)',
                        dataIndex: 'fk_id_estado_entidad',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_estado_entidad',
                            displayField: 'nombre_estado_entidad',
                            valueField: 'id_estado_entidad',
                            store: {
                                type: 'opciones.estadoentidad'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeEstadoEntidad.find('id_estado_entidad', valor);
                                var objRegistro = storeEstadoEntidad.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_estado_entidad');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        },
                        flex: .2
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'estado_entidad_estado_entidad',
                        trueText: 'Activo',
                        falseText: 'Inactivo', 
                        text: 'Estado (Registro)',
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
                        flex: .2
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_entidad_estado_entidad',
                        editor: {
                            xtype: 'textfield'
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