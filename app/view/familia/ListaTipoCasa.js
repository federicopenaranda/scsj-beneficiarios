Ext.define('sisscsj.view.familia.ListaTipoCasa', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.listatipocasa',
    store: 'FamiliaTipoCasa',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.familia.FamiliaTipoCasa',
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 250,
    initComponent: function() {

        var storeTipoCocina = Ext.data.StoreManager.lookup('opciones.TipoCocina');
        storeTipoCocina.load();
        
        var storeTipoCasa = Ext.data.StoreManager.lookup('opciones.TipoCasa');
        storeTipoCasa.load();
        
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
                        text: 'Tipo de Cocina',
                        dataIndex: 'fk_id_tipo_cocina',
                        renderer: function (valor){
                            if (valor !== null)
                            {
                                var intIndice = storeTipoCocina.find('id_tipo_cocina', valor);
                                var objRegistro = storeTipoCocina.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_cocina');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Tipo de Casa',
                        dataIndex: 'fk_id_tipo_casa',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoCasa.find('id_tipo_casa', valor);
                                var objRegistro = storeTipoCasa.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_casa');
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
                        dataIndex: 'observacion_familia_tipo_casa',
                        hidden: true
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_familia_tipo_casa',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Fecha Registro',
                        dataIndex: 'fecha_registro_familia_tipo_casa',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Cuartos Multiuso',
                        dataIndex: 'cuartos_multiuso_familia_tipo_casa',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Si';
                            
                            if ( valor === 0 )
                                return 'No';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Núm. Ambientes',
                        dataIndex: 'ambientes_familia_tipo_casa'
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