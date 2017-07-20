Ext.define('sisscsj.view.opciones.Lugar.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.lugar.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeTipoLugar = Ext.data.StoreManager.lookup('opciones.TipoLugar');
        storeTipoLugar.load();
        
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
                        text: 'Nombre',
                        dataIndex: 'nombre_lugar_actividad',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'fk_id_tipo_lugar',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoLugar.find('id_tipo_lugar', valor);
                                var objRegistro = storeTipoLugar.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_lugar');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        },
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_lugar',
                            displayField: 'nombre_tipo_lugar',
                            valueField: 'id_tipo_lugar',
                            store: {
                                type: 'opciones.tipolugar'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .2
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_lugar_actividad',
                        editor: {
                            xtype: 'textfield',
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

