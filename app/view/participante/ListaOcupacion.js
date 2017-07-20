Ext.define('sisscsj.view.participante.ListaOcupacion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.participante.listaocupacion',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.opciones.Ocupacion'
    ],
    minHeight: 250,
    store: 'ParticipanteOcupacion',
    initComponent: function() {
        
        var storeOcupacion = Ext.data.StoreManager.lookup('opciones.Ocupacion');
        storeOcupacion.load();
        
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Ocupación',
                        dataIndex: 'fk_id_ocupacion',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeOcupacion.find('id_ocupacion', valor);
                                var objRegistro = storeOcupacion.getAt(intIndice);
                                var txtNombreCampo = objRegistro.get('nombre_ocupacion');
                                if (txtNombreCampo != "")
                                {
                                    return txtNombreCampo;
                                }
                                else
                                {
                                    return "Error";
                                }
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Fecha de Ocupación',
                        dataIndex: 'fecha_beneficiario_ocupacion',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Estado Ocupación',
                        dataIndex: 'estado_beneficiario_ocupacion',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Observaciones Ocupación',
                        dataIndex: 'observacion_beneficiario_ocupacion'
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