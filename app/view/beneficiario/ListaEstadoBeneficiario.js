Ext.define('sisscsj.view.beneficiario.ListaEstadoBeneficiario', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.listaestadobeneficiario',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.opciones.EstadoBeneficiario',
        'sisscsj.store.opciones.EstadoBeneficiario',
        'sisscsj.model.opciones.BeneficiarioTipo',
        'sisscsj.store.opciones.BeneficiarioTipo',
        'sisscsj.model.opciones.EdadesBeneficiario',
        'sisscsj.store.opciones.EdadesBeneficiario',
        'sisscsj.model.opciones.TipoActor',
        'sisscsj.store.opciones.TipoActor'
    ],
    minHeight: 250,
    store: 'BeneficiarioEstadoBeneficiario',
    initComponent: function() {

        var storeEstadoBeneficiario = Ext.data.StoreManager.lookup('opciones.EstadoBeneficiario');
        storeEstadoBeneficiario.load();
        
        var storeBeneficiarioTipo = Ext.data.StoreManager.lookup('opciones.BeneficiarioTipo');
        storeBeneficiarioTipo.load();

        var storeEdadesBeneficiario = Ext.data.StoreManager.lookup('opciones.EdadesBeneficiario');
        storeEdadesBeneficiario.load();

        var storeTipoActorBeneficiario = Ext.data.StoreManager.lookup('opciones.TipoActor');
        storeTipoActorBeneficiario.load();

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
                        text: 'Estado',
                        dataIndex: 'fk_id_estado_beneficiario',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeEstadoBeneficiario.find('id_estado_beneficiario', valor);
                                var objRegistro = storeEstadoBeneficiario.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_estado_beneficiario');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'fk_id_beneficiario_tipo',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeBeneficiarioTipo.find('id_beneficiario_tipo', valor);
                                var objRegistro = storeBeneficiarioTipo.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_beneficiario_tipo');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Edad',
                        dataIndex: 'fk_id_edades_beneficiario',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeEdadesBeneficiario.find('id_edades_beneficiario', valor);
                                var objRegistro = storeEdadesBeneficiario.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_edades_beneficiario');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Tipo de Actor',
                        dataIndex: 'fk_id_tipo_actor_beneficiario',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeTipoActorBeneficiario.find('id_tipo_actor_beneficiario', valor);
                                var objRegistro = storeTipoActorBeneficiario.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_actor_beneficiario');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_asignacion_estado_beneficiario',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_beneficiario_estado_beneficiario',
                        hidden: true
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