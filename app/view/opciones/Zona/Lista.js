Ext.define('sisscsj.view.opciones.Zona.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.zona.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeLocalidad = Ext.data.StoreManager.lookup('opciones.Localidad');
        storeLocalidad.load();
        
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
                        text: 'Localidad',
                        dataIndex: 'fk_id_localidad',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_localidad',
                            displayField: 'nombre_localidad',
                            valueField: 'id_localidad',
                            store: {
                                type: 'opciones.localidad'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .5,
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeLocalidad.find('id_localidad', valor);
                                var objRegistro = storeLocalidad.getAt(intIndice);
                                var txtNombreCampo = objRegistro.get('nombre_localidad');
                                return (txtNombreCampo != "") ? txtNombreCampo : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Nombre de Zona',
                        dataIndex: 'nombre_zona',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .5
                    },
                    {
                        text: 'Descripción de Zona',
                        dataIndex: 'descripcion_zona',
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

