Ext.define('sisscsj.view.opciones.SubAreaActividad.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.subareaactividad.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging',
        'sisscsj.model.opciones.AreaActividad',
        'sisscsj.store.opciones.AreaActividad'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeAreaActividad = Ext.data.StoreManager.lookup('opciones.AreaActividad');
        storeAreaActividad.load();
        
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
                        dataIndex: 'nombre_sub_area',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        },
                        flex: .2
                    },
                    {
                        text: 'Área',
                        dataIndex: 'fk_id_area_actividad',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeAreaActividad.find('id_area_actividad', valor);
                                var objRegistro = storeAreaActividad.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_area_actividad');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        },
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_area_actividad',
                            displayField: 'nombre_area_actividad',
                            valueField: 'id_area_actividad',
                            store: {
                                type: 'opciones.areaactividad'
                            },
                            editable: false,
                            forceSelection: true
                        },
                        flex: .2
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_sub_area',
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

