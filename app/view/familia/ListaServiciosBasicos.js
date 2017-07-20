Ext.define('sisscsj.view.familia.ListaServicioBasico', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.listaserviciobasico',
    store: 'FamiliaServicioBasico',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.familia.FamiliaServicioBasico',
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 250,
    initComponent: function() {

        var storeServicioBasico = Ext.data.StoreManager.lookup('opciones.ServicioBasico');
        storeServicioBasico.load();
        
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
                defaults: {
                    flex: 1
                },
                items: [
                    {
                        text: 'Servicio',
                        dataIndex: 'fk_id_servicio_basico',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeServicioBasico.find('id_servicio_basico', valor);
                                var objRegistro = storeServicioBasico.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_servicio_basico');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Observación',
                        dataIndex: 'observacion_familia_servicio_basico'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_familia_servicio_basico',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
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
                }
            ]
        });
        me.callParent(arguments);
    }
});