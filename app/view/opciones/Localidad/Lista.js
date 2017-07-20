Ext.define('sisscsj.view.opciones.Localidad.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.localidad.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeProvincia = Ext.data.StoreManager.lookup('opciones.Provincia');
        storeProvincia.load();
        
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
                        text: 'Provincia',
                        dataIndex: 'fk_id_provincia',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_provincia',
                            displayField: 'nombre_provincia',
                            valueField: 'id_provincia',
                            store: {
                                type: 'opciones.provincia'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .5,
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeProvincia.find('id_provincia', valor);
                                var objRegistro = storeProvincia.getAt(intIndice);
                                var txtNombreCampo = objRegistro.get('nombre_provincia');
                                return (txtNombreCampo != "") ? txtNombreCampo : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Nombre de Localidad',
                        dataIndex: 'nombre_localidad',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .5
                    },
                    {
                        text: 'Descripción de Localidad',
                        dataIndex: 'descripcion_localidad',
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

