Ext.define('sisscsj.view.familia.MiembrosLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.familia.miembroslista',
    store: 'FamiliaMiembros',
    requires: [
        'Ext.toolbar.Paging',
        'sisscsj.model.familia.FamiliaMiembros'/*,
        'Ext.selection.CellModel',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.form.*'*/
    ],
    minHeight: 250,
    initComponent: function() {
        
        var storeParentesco = Ext.data.StoreManager.lookup('opciones.TipoParentesco');
        storeParentesco.load();
        
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 1
                },
                items: [
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
                        }
                    },
                    {
                        text: 'Parentesco',
                        dataIndex: 'fk_id_tipo_parentesco',
                        flex: .5,
                        renderer: function (valor){
                            if (valor !== null)
                            {
                                var intIndice = storeParentesco.find('id_tipo_parentesco', valor);
                                var objRegistro = storeParentesco.getAt(intIndice);
                                var txtNombre = objRegistro.get('nombre_tipo_parentesco');
                                return (txtNombre !== "") ? txtNombre : "Error";
                            }
                            else
                            {
                                return valor;
                            }
                        }
                    },
                    {
                        text: 'Vive en Casa?',
                        dataIndex: 'vive_casa_beneficiario_familia',
                        renderer: function (valor) {
                            if ( valor === 1 )
                            {
                                return 'Si';
                            }
                            else
                            {
                                return 'No';
                            }
                            
                            //return '';
                        },
                        flex: .5
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_beneficiario_familia',
                        renderer: function (valor) {
                            if ( valor === 1 )
                                return 'Activo';
                            
                            if ( valor === 0 )
                                return 'Inactivo';
                            
                            return '';
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
                }
            ]
        });
        me.callParent(arguments);
    }
});