Ext.define('sisscsj.view.usuario.ListaEntidad', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuario.listaentidad',
    store: 'UsuarioEntidad',
    requires: [
        /*'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'*/
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 310,
    initComponent: function() {

        var storeEntidad = Ext.data.StoreManager.lookup('entidad.Entidad');
        storeEntidad.load();

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
                        text: 'Entidad',
                        dataIndex: 'fk_id_entidad',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_entidad',
                            displayField: 'nombre_entidad',
                            valueField: 'id_entidad',
                            store: {
                                type: 'entidad.entidad'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeEntidad.find('id_entidad', valor);
                                var objRegistro = storeEntidad.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_entidad');
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
                        text: 'Fecha de Registro',
                        dataIndex: 'fecha_registro_usuario_entidad',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        editor: {
                            xtype: 'datefield'
                        },
                        flex: .2
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'estado_usuario_entidad',
                        trueText: 'Activo',
                        falseText: 'Inactivo', 
                        text: 'Estado',
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