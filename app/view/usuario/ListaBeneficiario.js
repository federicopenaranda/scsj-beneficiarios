Ext.define('sisscsj.view.usuario.BeneficiarioLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuario.beneficiariolista',
    store: 'UsuarioBeneficiario',
    requires: [
        /*'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'*/
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'
    ],
    minHeight: 310,
    initComponent: function() {

        var storeUsuario = Ext.data.StoreManager.lookup('usuario.Usuario');
        storeUsuario.load();

        var storeBeneficiario = Ext.data.StoreManager.lookup('beneficiario.Beneficiario');
        storeBeneficiario.load();

        var storeBeneficiarioGestion = Ext.data.StoreManager.lookup('beneficiario.BeneficiarioGestion');
        storeBeneficiarioGestion.load();

        var storeUsuarioBeneficiarioGestion = Ext.data.StoreManager.lookup('usuario.UsuarioBeneficiarioGestion');
        storeUsuarioBeneficiarioGestion.load();

        var me = this;
        
        Ext.applyIf(me, {
            columns: {
                defaults: {},
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function (valor){
                            if (valor != null)
                            {
                                var intIndice = storeUsuario.find('id_usuario', valor);
                                var objRegistro = storeUsuario.getAt(intIndice);
                                return objRegistro.get('login_usuario');
                            }
                            else
                            {
                                return valor;
                            }
                        },
                        flex: .2
                    },
                    {
                        text: 'Beneficiario',
                        dataIndex: 'fk_id_beneficiario',
                        renderer: function ( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: sisscsj.app.globals.globalServerPath + 'Beneficiario',
                                        params: {
                                            start: '0',
                                            limit: '1',
                                            filter: '[{"property":"id_beneficiario","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0],
                                                    tmpNombre = tmpUE.primer_nombre_beneficiario + ' ' 
                                                    + tmpUE.segundo_nombre_beneficiario + ' ' 
                                                    + tmpUE.apellido_paterno_beneficiario + ' ' 
                                                    + tmpUE.apellido_materno_beneficiario + ' ('
                                                    + tmpUE.codigo_beneficiario + ')';

                                            record.set('primer_nombre_beneficiario', tmpUE.primer_nombre_beneficiario);
                                            record.set('segundo_nombre_beneficiario', tmpUE.segundo_nombre_beneficiario);
                                            record.set('apellido_paterno_beneficiario', tmpUE.apellido_paterno_beneficiario);
                                            record.set('apellido_materno_beneficiario', tmpUE.apellido_materno_beneficiario);
                                            record.set('codigo_beneficiario', tmpUE.codigo_beneficiario);
                                            
                                            return tmpNombre;
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });

                                    return record.get('primer_nombre_beneficiario') + ' ' + 
                                        record.get('segundo_nombre_beneficiario') + ' ' + 
                                        record.get('apellido_paterno_beneficiario') + ' ' +
                                        record.get('apellido_materno_beneficiario') + ' (' +
                                        record.get('codigo_beneficiario') + ')' ;
                                
                                }
                                else
                                {
                                    return record.get('primer_nombre_beneficiario') + ' ' + 
                                        record.get('segundo_nombre_beneficiario') + ' ' + 
                                        record.get('apellido_paterno_beneficiario') + ' ' +
                                        record.get('apellido_materno_beneficiario') + ' (' +
                                        record.get('codigo_beneficiario') + ')' ;
                                }
                            }
                        },
                        flex: .2
                    }/*,
                    {
                        text: 'Gestión',
                        dataIndex: 'fk_id_gestion_beneficiario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_gestion' )
                        },
                        flex: .2
                    }*/,
                    {
                        text: 'Fecha de Asignación',
                        dataIndex: 'fecha_asignacion_usuario_beneficiario',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        flex: .2
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'estado_usuario_beneficiario',
                        trueText: 'Activo',
                        falseText: 'Inactivo', 
                        text: 'Estado',
                        flex: .2
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