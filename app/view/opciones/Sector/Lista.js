Ext.define('sisscsj.view.opciones.Sector.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.sector.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeZona = Ext.data.StoreManager.lookup('opciones.Zona');
        storeZona.load();
        
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            plugins: [
                {
                    ptype: 'rowediting',
                    clicksToEdit: 2,
                    saveBtnText: 'Guardar',
                    cancelBtnText: 'Cancelar',
                    errorsText: 'Errores',
                    dirtyText: 'Es necesario guardar o cancelar los cambios.'
                }
            ],
            columns: {
                defaults: {},
                items: [
                    {
                        text: 'Zona',
                        dataIndex: 'fk_id_zona',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_zona',
                            displayField: 'nombre_zona',
                            valueField: 'id_zona',
                            store: {
                                type: 'opciones.zona'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .5,
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeZona.find('id_zona', valor);
                                var objRegistro = storeZona.getAt(intIndice);
                                var txtNombreCampo = objRegistro.get('nombre_zona');
                                return (txtNombreCampo != "") ? txtNombreCampo : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Nombre de Sector',
                        dataIndex: 'nombre_sector',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .5
                    },
                    {
                        text: 'Descripción de Sector',
                        dataIndex: 'descripcion_sector',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
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
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore()
                }
            ]
        });
        me.callParent(arguments);
    }
});

