Ext.define('sisscsj.view.opciones.Donante.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.donante.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging',
        'sisscsj.model.opciones.TipoDonante',
        'sisscsj.store.opciones.TipoDonante'
    ],
    minHeight: 250,
    initComponent: function() {

        var storeTipoDonante = Ext.data.StoreManager.lookup('opciones.TipoDonante');
        storeTipoDonante.load();
        
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
                defaults: {
                    flex: 1
                },
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_donante',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'fk_id_tipo_donante',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_donante',
                            displayField: 'nombre_tipo_donante',
                            valueField: 'id_tipo_donante',
                            store: {
                                type: 'opciones.tipodonante'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoDonante.find('id_tipo_donante', valor);
                                var objRegistro = storeTipoDonante.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_donante');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_donante',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: true
                        }
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

