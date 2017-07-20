Ext.define('sisscsj.view.familia.ListaEventoVital', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.eventovitallista',
    store: 'FamiliaEventoVital',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.familia.FamiliaEventoVital',
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeTipoEventoVital = Ext.data.StoreManager.lookup('opciones.TipoEventoVital');
        storeTipoEventoVital.load();
        
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
                        text: 'Tipo de Evento Vital',
                        dataIndex: 'fk_id_tipo_evento_vital',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoEventoVital.find('id_tipo_evento_vital', valor);
                                var objRegistro = storeTipoEventoVital.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_evento_vital');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Fecha del Evento',
                        dataIndex: 'fecha_evento_vital_familia',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_evento_vital_familia'
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